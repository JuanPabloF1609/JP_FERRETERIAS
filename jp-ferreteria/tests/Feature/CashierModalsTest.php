<?php

namespace Tests\Feature;

use Tests\TestCase;

class CashierModalsTest extends TestCase
{
    /** @test */
    public function it_loads_the_cashier_modals()
    {
        $response = $this->get('/cashiermanager');

        $response->assertStatus(200);
        $response->assertSee('Crear Venta'); // Verifica que el texto del modal de creación esté presente
        $response->assertSee('Editar Venta'); // Verifica que el texto del modal de edición esté presente
    }
}