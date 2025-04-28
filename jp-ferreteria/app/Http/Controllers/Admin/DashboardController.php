<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Productos;
use App\Models\Alertas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function handleDashboard()
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('view_admin_dashboard')) {
            return $this->adminDashboard();
        } elseif ($user->hasPermissionTo('view_caja_dashboard')) {
            return $this->cajaDashboard();
        } elseif ($user->hasPermissionTo('view_delivery_dashboard')) {  // Corregí "delivery_dashboard" (faltaba una 'a')
            return $this->deliveryDashboard();
        }

        return redirect()->route('logout');
    }

    protected function adminDashboard()
    {
        $data = [
            'totalVentas' => Factura::count(),
            'totalProductosVendidos' => $this->getTotalProductosVendidos(),
            'inventarioBajo' => Alertas::where('ESTADO_ALERTA', 'Pendiente')->count(),
            'usuariosRegistrados' => User::count()
        ];

        return view('dashboards.admin-dashboard', $data);
    }

    protected function cajaDashboard()
    {
        return view('dashboards.caja-dashboard', [
            'ventasHoy' => Factura::whereDate('FECHA_FACTURA', today())->count()
        ]);
    }

    protected function deliveryDashboard()
    {
        return view('dashboards.delivery-dashboard', [
            'entregasPendientes' => 0  // Reemplaza con tu consulta real
        ]);
    }

    protected function getTotalProductosVendidos()
    {
        return Factura::withCount('productos')->get()->sum('productos_count');
    }
}