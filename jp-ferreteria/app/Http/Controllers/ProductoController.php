<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Importa el modelo Producto
use App\Models\FotoProducto; // Importa el modelo FotoProducto
use App\Models\Categoria; // Importa el modelo Categoria

class ProductoController extends Controller
{
    /**
     * Muestra el dashboard de gestión de productos
     */
    public function index()
    {
        // Obtener los productos con sus categorías
        $productos = Producto::select('ID_PRODUCTO', 'NOMBRE_PRODUCTO', 'PRECIO', 'CANTIDAD', 'ID_CATEGORIA', 'DESCRIPCION', 'ESTADO')
            ->with('categoria:NOMBRE_CATEGORIA,ID_CATEGORIA') // Relación con la categoría
            ->get();

        // Obtener todas las categorías
        $categorias = Categoria::select('ID_CATEGORIA', 'NOMBRE_CATEGORIA')->get();
        
        // Datos de ejemplo para las estadísticas
        $estadisticas = [
            'inventario' => $productos->count(),
            'bajo_stock' => $productos->where('CANTIDAD', '<', 10)->count(),
            'inactivos' => $productos->where('ESTADO', 'inactivo')->count(), // Agrega esto
        ];

        return view('ferreteria.products.producto', compact('productos', 'estadisticas', 'categorias'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'NOMBRE_PRODUCTO' => 'required|string|max:255',
            'PRECIO' => 'required|numeric|min:0',
            'CANTIDAD' => 'required|integer|min:0',
            'STOCK_MINIMO' => 'nullable|integer|min:0',
            'ID_CATEGORIA' => 'nullable|integer',
            'REFERENCIA' => 'nullable|string|max:255',
            'DESCRIPCION' => 'nullable|string',
            'MARCA' => 'nullable|string|max:100',
            'COLOR' => 'nullable|string|max:50',
            'UNIDAD_MEDIDA' => 'nullable|string|max:20',
            'MATERIAL' => 'nullable|string|max:100',
            'DIMENSIONES' => 'nullable|string|max:100',
            'USO' => 'nullable|string|max:100',
            'NORMA' => 'nullable|string|max:100',
            'PROCEDENCIA' => 'nullable|string|max:100',
            'OFERTA' => 'nullable|boolean',
            'PRECIO_OFERTA' => 'nullable|numeric|min:0',
            'CUOTAS' => 'nullable|integer|min:1',
            'CUOTA_VALOR' => 'nullable|numeric|min:0',
            'MAS_VENDIDO' => 'nullable|boolean',
            'CARACTERISTICAS' => 'nullable|string',
        ]);


        // Guardar el producto en la base de datos
        $producto = Producto::create([
            'NOMBRE_PRODUCTO' => $validated['NOMBRE_PRODUCTO'],
            'PRECIO' => $validated['PRECIO'],
            'CANTIDAD' => $validated['CANTIDAD'],
            'STOCK_MINIMO' => $validated['STOCK_MINIMO'] ?? null,
            'ID_CATEGORIA' => $validated['ID_CATEGORIA'] ?? null,
            'REFERENCIA' => $validated['REFERENCIA'] ?? null,
            'DESCRIPCION' => $validated['DESCRIPCION'] ?? null,
            'MARCA' => $validated['MARCA'] ?? null,
            'COLOR' => $validated['COLOR'] ?? null,
            'UNIDAD_MEDIDA' => $validated['UNIDAD_MEDIDA'] ?? null,
            'MATERIAL' => $validated['MATERIAL'] ?? null,
            'DIMENSIONES' => $validated['DIMENSIONES'] ?? null,
            'USO' => $validated['USO'] ?? null,
            'NORMA' => $validated['NORMA'] ?? null,
            'PROCEDENCIA' => $validated['PROCEDENCIA'] ?? null,
            'OFERTA' => $request->has('OFERTA') ? 1 : 0,
            'PRECIO_OFERTA' => $validated['PRECIO_OFERTA'] ?? null,
            'CUOTAS' => $validated['CUOTAS'] ?? null,
            'CUOTA_VALOR' => $validated['CUOTA_VALOR'] ?? null,
            'MAS_VENDIDO' => $request->has('MAS_VENDIDO') ? 1 : 0,
            'CARACTERISTICAS' => $validated['CARACTERISTICAS'] ?? null,
        ]);

        

        // Subir y guardar las fotos en la tabla `fotos_productos`
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('productos', 'public');
                    FotoProducto::create([
                        'ID_PRODUCTO' => $producto->ID_PRODUCTO,
                        'URL_FOTO' => $path,
                    ]);
                }
            }
        }

        

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.product')->with('success', 'Producto creado exitosamente.');
    }
    
    public function buscar(Request $request)
    {
        $term = $request->input('q');
        
        $productos = Producto::where('NOMBRE_PRODUCTO', 'LIKE', "%{$term}%")
                ->orWhere('ID_PRODUCTO', $term)
                ->get();
                
        return response()->json($productos);
    }
    
    public function disable($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->ESTADO = 'inactivo';
        $producto->save();
        return response()->json(['success' => true]);
    }
    
    public function enable($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->ESTADO = 'activo';
        $producto->save();
        return response()->json(['success' => true]);
    }
    
    public function show($id)
    {
        $producto = Producto::with('fotos')->findOrFail($id);
        return response()->json($producto);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'NOMBRE_PRODUCTO' => 'required|string|max:255',
            'PRECIO' => 'required|numeric|min:0',
            'CANTIDAD' => 'required|integer|min:0',
            'STOCK_MINIMO' => 'nullable|integer|min:0',
            'ID_CATEGORIA' => 'nullable|integer',
            'REFERENCIA' => 'nullable|string|max:255',
            'DESCRIPCION' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $producto = Producto::findOrFail($id);

        // Eliminar las imágenes existentes del almacenamiento y la base de datos
        $imagenesExistentes = $producto->fotos;
        foreach ($imagenesExistentes as $imagen) {
            // Eliminar la imagen del almacenamiento
            \Storage::disk('public')->delete($imagen->URL_FOTO);

            // Eliminar la imagen de la base de datos
            $imagen->delete();
        }
        
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $path = $foto->store('productos', 'public');
                    FotoProducto::create([
                        'ID_PRODUCTO' => $producto->ID_PRODUCTO,
                        'URL_FOTO' => $path,
                    ]);
                }
            }
        }
    
        $producto->update($validated);

        // Resolver alertas si el stock supera el mínimo
        if ($producto->CANTIDAD > ($producto->STOCK_MINIMO ?? 0)) {
            \App\Models\Alerta::where('ID_PRODUCTO', $producto->ID_PRODUCTO)
                ->where('ESTADO_ALERTA', 'Pendiente')
                ->update(['ESTADO_ALERTA' => 'Resuelta']);
        }
    
        return redirect()->route('admin.product')->with('success', 'Producto actualizado exitosamente.');
    }
    
    public function stocks()
    {
        $stocks = \App\Models\Producto::pluck('CANTIDAD', 'ID_PRODUCTO');
        return response()->json($stocks);
    }
}