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
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
            ['nombre' => 'Algo', 'cantidad' => 150, 'precio' => 100, 'imagen' => 'https://via.placeholder.com/150'],
        ];

        return view('cashier.dash_cashier', compact('productos'));
    }
}