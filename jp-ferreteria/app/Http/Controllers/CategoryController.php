<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoryController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías y estadísticas
        $categorias = Categoria::all();
        $estadisticas = [
            'categorias_activas' => Categoria::count(),
            'categorias_inactivas' => 0, // Ajustar si se implementa lógica para inactivas
        ];

        // Retorna la vista de categorías con datos
        return view('ferreteria.categories.category', compact('categorias', 'estadisticas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'NOMBRE_CATEGORIA' => 'required|string|max:100',
            'DESCRIPCION' => 'nullable|string',
        ]);

        // Crear una nueva categoría
        Categoria::create([
            'NOMBRE_CATEGORIA' => $request->NOMBRE_CATEGORIA,
            'DESCRIPCION' => $request->DESCRIPCION,
        ]);

        // Redirigir a la vista con un mensaje de éxito
        return redirect()->route('category.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NOMBRE_CATEGORIA' => 'required|string|max:100',
            'DESCRIPCION' => 'nullable|string',
        ]);
    
        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'NOMBRE_CATEGORIA' => $request->NOMBRE_CATEGORIA,
            'DESCRIPCION' => $request->DESCRIPCION,
        ]);
    
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'id' => $categoria->ID_CATEGORIA,
                'nombre' => $categoria->NOMBRE_CATEGORIA,
                'descripcion' => $categoria->DESCRIPCION,
            ]);
        }
    
        return redirect()->route('category.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }
    

    public function disable($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete(); // O cambiar estado si se maneja lógica de inactivas

        return redirect()->route('category.index')->with('success', 'Categoría deshabilitada exitosamente.');
    }
}
