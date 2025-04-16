<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeliverymanDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_delivery_route_is_accessible()
    {
        // Simula un usuario autenticado
        $response = $this->get('/dashboard-delivery');

        // Verifica que la ruta devuelve un código 200
        $response->assertStatus(200);

        // Verifica que la vista correcta es cargada
        $response->assertViewIs('Dashboard_delivery_man');
    }

    public function test_historico_delivery_route_is_accessible()
    {
        $response = $this->get('/historico-delivery');

        $response->assertStatus(200);
        $response->assertViewIs('Historico_delivery_man');
    }
}