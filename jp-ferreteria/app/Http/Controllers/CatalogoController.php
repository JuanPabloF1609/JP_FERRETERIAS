<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Factura;

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

                // Registrar en la tabla pivote
                $factura->productos()->attach($item['ID_PRODUCTO'], [
                    'CANTIDAD' => $item['quantity'],
                    'DESCUENTO' => 0, // Ajustar si se requiere un descuento
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Compra finalizada y guardada correctamente.']);
        } catch (\Exception $e) {
            // Manejar errores y devolver una respuesta adecuada
            return response()->json(['success' => false, 'message' => 'Error al procesar la compra.', 'error' => $e->getMessage()], 500);
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

}