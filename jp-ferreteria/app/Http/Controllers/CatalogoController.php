<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\OrdenEntrega;
use App\Models\User;
use App\Models\EstadoOrden;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class CatalogoController extends Controller
{
    /**
     * Muestra el catálogo de productos.
     */
    public function index()
    {
        // Obtener los productos con sus fotos asociadas
        $productos = Producto::with('fotos')->get();

        return view('ferreteria.bills.catalogo', compact('productos'));
    }

    /**
     * Procesar la compra y guardar la información en la base de datos.
     */
    public function finalizarCompra(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'id' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'total' => 'required|numeric|min:0',
            'cart' => 'required|array',
            'cart.*.ID_PRODUCTO' => 'required|exists:productos,ID_PRODUCTO',
            'cart.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            // Crear o buscar cliente
            $cliente = Cliente::firstOrCreate(
                ['CC_NIT_CLIENTE' => $validated['id']],
                [
                    'NOMBRE_CLIENTE' => $validated['name'],
                    'DIRECCION_CLIENTE' => $validated['address'],
                    'TELEFONO_CLIENTE' => $validated['phone'],
                    'CORREO_CLIENTE' => $validated['email'],
                ]
            );

            // Crear factura
            $factura = Factura::create([
                'ID_CLIENTE' => $cliente->ID_CLIENTE,
                'TOTAL' => $validated['total'],
            ]);

            // Registrar productos en la tabla pivote factura_prod y actualizar la cantidad en el inventario
            foreach ($validated['cart'] as $item) {
                $producto = Producto::findOrFail($item['ID_PRODUCTO']);

                // Verificar si hay suficiente stock
                if ($producto->CANTIDAD < $item['quantity']) {
                    return response()->json(['success' => false, 'message' => "El producto {$producto->NOMBRE_PRODUCTO} no tiene suficiente stock."], 400);
                }

                // Reducir la cantidad del producto en el inventario
                $producto->CANTIDAD -= $item['quantity'];
                $producto->save();

                // Calcular umbral del 20% para alerta temprana
                $umbralTemprano = ceil($producto->STOCK_MINIMO + (($producto->STOCK_MINIMO * 20) / 100));

                // ALERTA TEMPRANA (20% por encima del mínimo)
                if ($producto->CANTIDAD <= $umbralTemprano && $producto->CANTIDAD > $producto->STOCK_MINIMO) {
                    $alertaTemprana = \App\Models\Alerta::where('ID_PRODUCTO', $producto->ID_PRODUCTO)
                        ->where('ESTADO_ALERTA', 'Pendiente')
                        ->where('COMENTARIO', 'like', '%temprana%')
                        ->first();

                    if (!$alertaTemprana) {
                        \App\Models\Alerta::create([
                            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
                            'COMENTARIO' => 'Alerta temprana: el producto está cerca del stock mínimo.',
                            'ESTADO_ALERTA' => 'Pendiente',
                            'FECHA_ALERTA' => now(),
                        ]);
                        // Enviar SMS
                        try {
                            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
                            $twilio->messages->create(
                                env('ALERTA_SMS_TO'),
                                [
                                    "messagingServiceSid" => env('TWILIO_MESSAGING_SERVICE_SID'),
                                    "body" => "ALERTA TEMPRANA: El producto {$producto->NOMBRE_PRODUCTO} está cerca del stock mínimo."
                                ]
                            );
                        } catch (\Exception $e) {
                            // Puedes registrar el error si lo deseas
                        }
                    }
                }

                // ALERTA DE STOCK MÍNIMO
                if ($producto->CANTIDAD <= $producto->STOCK_MINIMO) {
                    $alertaExistente = \App\Models\Alerta::where('ID_PRODUCTO', $producto->ID_PRODUCTO)
                        ->where('ESTADO_ALERTA', 'Pendiente')
                        ->where('COMENTARIO', 'not like', '%temprana%')
                        ->first();

                    if (!$alertaExistente) {
                        \App\Models\Alerta::create([
                            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
                            'COMENTARIO' => 'El producto ha alcanzado el stock mínimo.',
                            'ESTADO_ALERTA' => 'Pendiente',
                            'FECHA_ALERTA' => now(),
                        ]);
                        \Log::info('Intentando enviar SMS de alerta para producto: ' . $producto->NOMBRE_PRODUCTO);
                        try {
                            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
                            $twilio->messages->create(
                                env('ALERTA_SMS_TO'),
                                [
                                    "messagingServiceSid" => env('TWILIO_MESSAGING_SERVICE_SID'),
                                    "body" => "ALERTA: El producto {$producto->NOMBRE_PRODUCTO} ha alcanzado el stock mínimo."
                                ]
                            );
                        } catch (\Exception $e) {
                            \Log::error('Error al enviar SMS: ' . $e->getMessage());
                        }
                    }
                }

                // Registrar en la tabla pivote
                $factura->productos()->attach($item['ID_PRODUCTO'], [
                    'CANTIDAD' => $item['quantity'],
                    'DESCUENTO' => 0,
                ]);
            }

            // 1. Obtener todos los domiciliarios
            $domiciliarios = User::role('domiciliario')->get();

            if ($domiciliarios->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No hay domiciliarios disponibles.'], 400);
            }

            // 2. Algoritmo round robin: buscar el domiciliario con menos órdenes activas
            $domiciliarioAsignado = $domiciliarios->sortBy(function ($user) {
                return OrdenEntrega::where('ID_USER', $user->id)
                    ->whereHas('estado', function($q) {
                        $q->where('NOMBRE_ESTADO_ORDEN', 'No_Entregado'); // <-- Esto es correcto
                    })->count();
            })->first();

            // 3. Estado inicial de la orden (debe ser 'No_Entregado')
            $estadoOrden = EstadoOrden::where('NOMBRE_ESTADO_ORDEN', 'No_Entregado')->first();

            // 4. Crear la orden de entrega
            OrdenEntrega::create([
                'ID_USER' => $domiciliarioAsignado->id,
                'ID_FACTURA' => $factura->ID_FACTURA,
                'ID_ESTADO_ORDEN' => $estadoOrden ? $estadoOrden->ID_ESTADO_ORDEN : null,
                'FECHA_ORDEN' => now(),
                'DIRECCION_ENTREGA' => $validated['address'] ?? $cliente->DIRECCION_CLIENTE,
            ]);

            return response()->json(['success' => true, 'message' => 'Compra finalizada y orden de entrega creada correctamente.']);
        } catch (\Exception $e) {
            \Log::error('Error en finalizarCompra: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la compra.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear una venta desde el modal.
     */
    public function crearVenta(Request $request)
    {
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'direccion_cliente' => 'required|string|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'correo_cliente' => 'required|email|max:100',
            'identificacion_cliente' => 'required|string|max:20',
            'producto' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);

        // Crear o buscar cliente
        $cliente = Cliente::firstOrCreate(
            ['CC_NIT_CLIENTE' => $validated['identificacion_cliente']],
            [
                'NOMBRE_CLIENTE' => $validated['nombre_cliente'],
                'DIRECCION_CLIENTE' => $validated['direccion_cliente'],
                'TELEFONO_CLIENTE' => $validated['telefono_cliente'],
                'CORREO_CLIENTE' => $validated['correo_cliente'],
            ]
        );

        // Crear factura
        $factura = Factura::create([
            'ID_CLIENTE' => $cliente->ID_CLIENTE,
            'TOTAL' => $validated['total'],
        ]);

        // Registrar el producto en la tabla pivote
        $producto = Producto::where('NOMBRE_PRODUCTO', $validated['producto'])->first();
        if ($producto) {
            $factura->productos()->attach($producto->ID_PRODUCTO, [
                'CANTIDAD' => 1, // Ajustar según la lógica de cantidad
                'DESCUENTO' => 0,
            ]);
        } else {
            return redirect()->back()->with('error', 'El producto especificado no existe.');
        }

        return redirect()->back()->with('success', 'Venta creada correctamente.');
    }

    /**
     * Muestra los pedidos.
     */
    public function pedidos()
    {
        // Obtener todas las ventas con sus relaciones
        $ventas = Factura::with(['cliente', 'productos'])->get();

        // Contar las ventas finalizadas basándose en los registros visibles en la tabla
        $ventasFinalizadas = $ventas->count();

        // Contar la cantidad de productos en el catálogo
        $productosEnCatalogo = Producto::count();

        return view('ferreteria.bills.pedidos', compact('ventas', 'productosEnCatalogo', 'ventasFinalizadas'));
    }

    /**
     * Editar una venta.
     */
    public function editarVenta(Request $request)
    {
        $validated = $request->validate([
            'id_factura' => 'required|exists:factura,ID_FACTURA',
            'nombre_cliente' => 'required|string|max:100',
            'telefono_cliente' => 'required|string|max:20',
            'correo_cliente' => 'required|email|max:100',
            'producto' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);

        // Buscar la factura y el cliente asociado
        $factura = Factura::findOrFail($validated['id_factura']);
        $cliente = $factura->cliente;

        // Actualizar la información del cliente
        $cliente->update([
            'NOMBRE_CLIENTE' => $validated['nombre_cliente'],
            'TELEFONO_CLIENTE' => $validated['telefono_cliente'],
            'CORREO_CLIENTE' => $validated['correo_cliente'],
        ]);

        // Actualizar el total de la factura
        $factura->update([
            'TOTAL' => $validated['total'],
        ]);

        // Actualizar el producto (si es necesario, implementar lógica adicional para productos)
        // Aquí puedes actualizar la tabla pivote factura_prod si es necesario.

        return redirect()->back()->with('success', 'Venta actualizada correctamente.');
    }

    public function toggleEstadoVenta($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->ESTADO = ($factura->ESTADO === 'Activo') ? 'Inactivo' : 'Activo';
        $factura->save();

        return redirect()->back()->with('success', 'Estado de la venta actualizado correctamente.');
    }

    public function misOrdenes()
    {
        $user = Auth::user();

        // Orden activa (la primera con estado 'Activo')
        $ordenActiva = OrdenEntrega::with(['factura.cliente', 'factura.productos'])
            ->where('ID_USER', $user->id)
            ->whereHas('estado', function($q) {
                $q->where('NOMBRE_ESTADO_ORDEN', 'Activo');
            })
            ->orderBy('FECHA_ORDEN')
            ->first();

        // Órdenes en cola (las siguientes con estado 'Activo')
        $ordenesCola = OrdenEntrega::with(['factura.cliente', 'factura.productos'])
            ->where('ID_USER', $user->id)
            ->whereHas('estado', function($q) {
                $q->where('NOMBRE_ESTADO_ORDEN', 'Activo');
            })
            ->orderBy('FECHA_ORDEN')
            ->skip(1)
            ->take(5)
            ->get();

        return view('ferreteria.orders.orders', compact('ordenActiva', 'ordenesCola'));
    }

}