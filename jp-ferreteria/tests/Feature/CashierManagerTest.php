<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CashierManagerTest extends TestCase
{
    /** @test */
    public function it_loads_the_cashier_manager_view()
    {
        $response = $this->get('/cashiermanager');

        $response->assertStatus(200);
        $response->assertSee('Gestión de ventas'); // Verifica que el texto esté en la vista
    }
}