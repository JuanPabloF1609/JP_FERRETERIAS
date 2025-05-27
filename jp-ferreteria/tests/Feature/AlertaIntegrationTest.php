<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Alerta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlertaIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserSeeder::class);
    }

    protected function actingAsAdmin()
    {
        $admin = User::where('email', 'admin@admin.com')->first();
        $this->actingAs($admin);
    }

    public function test_crear_alerta_para_producto()
    {
        $this->actingAsAdmin();
        $producto = Producto::factory()->create();

        $alerta = Alerta::create([
            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
            'COMENTARIO' => 'Stock bajo',
            'ESTADO_ALERTA' => 'Pendiente',
            'FECHA_ALERTA' => now(),
        ]);

        $this->assertDatabaseHas('alertas', [
            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
            'COMENTARIO' => 'Stock bajo',
            'ESTADO_ALERTA' => 'Pendiente',
        ]);
    }

    public function test_relacion_alerta_producto()
    {
        $producto = Producto::factory()->create();
        $alerta = Alerta::factory()->create(['ID_PRODUCTO' => $producto->ID_PRODUCTO]);

        $this->assertEquals($producto->ID_PRODUCTO, $alerta->producto->ID_PRODUCTO);
    }

    public function test_admin_puede_ver_alertas_pendientes()
    {
        $this->actingAsAdmin();
        $producto = Producto::factory()->create();
        Alerta::factory()->create([
            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
            'ESTADO_ALERTA' => 'Pendiente',
        ]);

        $response = $this->get(route('admin.alertasPendientes'));
        $response->assertStatus(200);
        $response->assertJsonFragment(['ESTADO_ALERTA' => 'Pendiente']);
    }
}