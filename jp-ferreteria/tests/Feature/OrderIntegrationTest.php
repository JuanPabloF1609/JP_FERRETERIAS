<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Factura;
use App\Models\OrdenEntrega;
use App\Models\EstadoOrden;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserSeeder::class);
    }

    protected function actingAsDomiciliario()
    {
        $domi = User::where('email', 'domi@domi.com')->first();
        $this->actingAs($domi);
        return $domi;
    }


    public function test_domiciliario_puede_marcar_orden_como_entregada()
    {
        $domi = $this->actingAsDomiciliario();
        $estadoNoEntregado = EstadoOrden::where('NOMBRE_ESTADO_ORDEN', 'No_Entregado')->first();
        $estadoEntregado = EstadoOrden::where('NOMBRE_ESTADO_ORDEN', 'Entregado')->first();

        $factura = Factura::factory()->create();
        $orden = OrdenEntrega::create([
            'ID_USER' => $domi->id,
            'ID_FACTURA' => $factura->ID_FACTURA,
            'ID_ESTADO_ORDEN' => $estadoNoEntregado->ID_ESTADO_ORDEN,
            'FECHA_ORDEN' => now(),
            'DIRECCION_ENTREGA' => 'Calle Prueba',
        ]);

        $response = $this->post(route('orders.entregar', $orden->ID_ORDEN));
        $response->assertRedirect();

        $this->assertDatabaseHas('ordenes_de_entrega', [
            'ID_ORDEN' => $orden->ID_ORDEN,
            'ID_ESTADO_ORDEN' => $estadoEntregado->ID_ESTADO_ORDEN,
        ]);
    }


}