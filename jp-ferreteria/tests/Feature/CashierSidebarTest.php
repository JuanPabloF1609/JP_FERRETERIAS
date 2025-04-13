<?php

namespace Tests\Feature;

use Tests\TestCase;

class CashierSidebarTest extends TestCase
{
    /** @test */
    public function it_loads_the_cashier_sidebar()
    {
        $response = $this->get('/cashiermanager');

        $response->assertStatus(200);
        $response->assertSee('Ventas'); // Verifica que el botón "Ventas" esté presente
        $response->assertSee('Catálogo'); // Verifica que el botón "Catálogo" esté presente
        $response->assertSee('Cerrar Sesión'); // Verifica que el botón "Cerrar Sesión" esté presente
    }
}