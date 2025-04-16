<?php

namespace Tests\Feature\Cashier;

use Tests\TestCase;

class CashierLayoutTest extends TestCase
{
    /** @test */
    public function it_loads_the_cashier_layout()
    {
        $response = $this->get('/cashiermanager');

        $response->assertStatus(200);
        $response->assertSee('<title>Gestión de Ventas</title>', false); // Verifica que el título esté en la vista
    }
}