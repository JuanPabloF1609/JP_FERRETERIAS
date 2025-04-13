<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra el dashboard de gestión de productos
     */
    public function index()
    {
        // Datos de ejemplo para las estadísticas
        $estadisticas = [
            'inventario' => 12,
            'bajo_stock' => 3,
            'inactivos' => 3
        ];

        return view('dashboard', compact('estadisticas'));
    }
}