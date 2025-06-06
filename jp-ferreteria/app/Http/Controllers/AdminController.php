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
        $ventasHoy = \App\Models\Factura::whereDate('created_at', today())->count();
        $productosVendidos = \App\Models\Factura::with('productos')->get()->sum(function($factura) {
            return $factura->productos->sum('pivot.CANTIDAD');
        });
        $inventarioBajo = \App\Models\Producto::whereColumn('CANTIDAD', '<=', 'STOCK_MINIMO')->count();
        $clientesNuevos = \App\Models\Cliente::whereDate('created_at', today())->count();

        $estadisticas = [
            'ventas_hoy' => $ventasHoy,
            'productos_vendidos' => $productosVendidos,
            'inventario_bajo' => $inventarioBajo,
            'clientes_nuevos' => $clientesNuevos,
        ];

        return view('ferreteria.products.dash_admin', compact('estadisticas'));
    }

    public function alertasPendientes()
    {
        $alertas = \App\Models\Alerta::with('producto')
            ->where('ESTADO_ALERTA', 'Pendiente')
            ->orderBy('FECHA_ALERTA', 'desc')
            ->get();

        return response()->json($alertas);
    }

    public function alertasVista()
    {
        $alertas = \App\Models\Alerta::with('producto')
            ->where('ESTADO_ALERTA', 'Pendiente')
            ->orderBy('FECHA_ALERTA', 'desc')
            ->get();

        return view('admin.alertas', compact('alertas'));
    }
}