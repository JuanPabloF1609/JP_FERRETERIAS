<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenEntrega;

class OrderController extends Controller
{
    /**
     * Muestra el dashboard del repartidor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Órdenes activas (estado "Entregado" o lógica que necesites)
        $ordenActiva = OrdenEntrega::with(['usuario', 'factura.cliente', 'factura.productos'])
            ->where('ID_ESTADO_ORDEN', 2) // Ejemplo: ID 2 = "Entregado"
            ->latest('FECHA_ORDEN')
            ->first();

        // Órdenes en cola (estado "No_Entregado")
        $ordenesCola = OrdenEntrega::with(['usuario', 'factura.cliente', 'factura.productos'])
            ->where('ID_ESTADO_ORDEN', 1) // Ejemplo: ID 1 = "No_Entregado"
            ->orderBy('FECHA_ORDEN')
            ->get();

        return view('ferreteria.orders.orders', [
            'ordenActiva' => $ordenActiva,
            'ordenesCola' => $ordenesCola,
        ]);
    }
}