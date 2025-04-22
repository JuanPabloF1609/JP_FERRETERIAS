<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Muestra el dashboard de cashier
     */
    public function index()
    {
        // Datos de ejemplo para los productos
        $productos = [
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 1000, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo2', 'cantidad' => 150, 'precio' => 1500, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo3', 'cantidad' => 150, 'precio' => 1700, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo4', 'cantidad' => 150, 'precio' => 1200, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo5', 'cantidad' => 150, 'precio' => 1300, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo6', 'cantidad' => 150, 'precio' => 1030, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo7', 'cantidad' => 150, 'precio' => 1010, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo8', 'cantidad' => 150, 'precio' => 1070, 'imagen' => 'https://via.placeholder.com/150'],
        ];

        return view('cashier.index', compact('productos'));
    }
}