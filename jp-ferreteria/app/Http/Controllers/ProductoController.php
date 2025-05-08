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
        $productos = Producto::select('ID_PRODUCTO', 'NOMBRE_PRODUCTO', 'PRECIO', 'CANTIDAD', 'ID_CATEGORIA', 'DESCRIPCION')
            ->with('categoria:NOMBRE_CATEGORIA,ID_CATEGORIA') // Relación con la categoría
            ->get();

        // Obtener todas las categorías
        $categorias = Categoria::select('ID_CATEGORIA', 'NOMBRE_CATEGORIA')->get();
        
        // Datos de ejemplo para las estadísticas
        $estadisticas = [
            'inventario' => $productos->count(),
            'bajo_stock' => $productos->where('CANTIDAD', '<', 10)->count(),
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
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);
    
        // Cambiar el estado del producto (puedes usar un campo como 'activo' o similar)
        $producto->update(['activo' => false]);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.product')->with('success', 'Producto deshabilitado exitosamente.');
    }
    
    public function enable($id)
    {
        // Buscar el producto por ID
        $producto = Producto::findOrFail($id);

        // Cambiar el estado del producto a activo
        $producto->update(['activo' => true]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.product')->with('success', 'Producto habilitado exitosamente.');
    }
    
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
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
    
        return redirect()->route('admin.product')->with('success', 'Producto actualizado exitosamente.');
    }
}