<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdenEntrega;
use App\Models\EstadoOrden;

class OrderController extends Controller
{
    /**
     * Muestra el dashboard del repartidor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $ordenActiva = OrdenEntrega::with(['factura.cliente', 'factura.productos'])
            ->where('ID_USER', $user->id)
            ->whereHas('estado', function($q) {
                $q->where('NOMBRE_ESTADO_ORDEN', 'No_Entregado');
            })
            ->orderBy('FECHA_ORDEN')
            ->first();

        $ordenesCola = OrdenEntrega::with(['factura.cliente', 'factura.productos'])
            ->where('ID_USER', $user->id)
            ->whereHas('estado', function($q) {
                $q->where('NOMBRE_ESTADO_ORDEN', 'No_Entregado');
            })
            ->orderBy('FECHA_ORDEN')
            ->skip(1)
            ->take(5)
            ->get();

        return view('ferreteria.orders.orders', compact('ordenActiva', 'ordenesCola'));
    }

    public function marcarEntregada($id)
    {
        $orden = OrdenEntrega::findOrFail($id);
        $estadoEntregado = EstadoOrden::where('NOMBRE_ESTADO_ORDEN', 'Entregado')->first();

        if ($estadoEntregado) {
            $orden->ID_ESTADO_ORDEN = $estadoEntregado->ID_ESTADO_ORDEN;
            $orden->save();
            return redirect()->back()->with('success', 'Orden marcada como entregada.');
        } else {
            return redirect()->back()->with('error', 'No se encontró el estado Entregado.');
        }
    }
}