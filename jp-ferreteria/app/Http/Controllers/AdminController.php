<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el dashboard de administrador
     */
    public function index()
    {
        
        // Si no tienes los modelos o las métricas reales, puedes usar datos estáticos por ahora
        $estadisticas = [
            'usuarios_activos' => 25,
            'ventas_totales' => 1250,
            'productos_activos' => 180,
            'ordenes_pendientes' => 10,
        ];

        return view('dash_admin', compact('estadisticas'));
    }
}