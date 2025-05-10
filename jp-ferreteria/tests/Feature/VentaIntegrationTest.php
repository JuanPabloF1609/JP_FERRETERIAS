<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VentaIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\UserSeeder::class);
    }

    protected function actingAsCaja()
    {
        $caja = User::where('email', 'caja@caja.com')->first();
        $this->actingAs($caja);
    }

    public function test_caja_puede_crear_venta()
    {
        $this->actingAsCaja();
        $producto = Producto::factory()->create();

        $response = $this->post(route('ventas.crear'), [
            'nombre_cliente' => 'Cliente Test',
            'direccion_cliente' => 'Calle 123',
            'telefono_cliente' => '123456789',
            'correo_cliente' => 'cliente@test.com',
            'identificacion_cliente' => '1234567890',
            'producto' => $producto->NOMBRE_PRODUCTO,
            'total' => 1000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('clientes', ['NOMBRE_CLIENTE' => 'Cliente Test']);
        $this->assertDatabaseHas('factura', ['TOTAL' => 1000]);
    }

    public function test_caja_puede_editar_venta()
    {
        $this->actingAsCaja();
        $cliente = Cliente::factory()->create();
        $factura = Factura::factory()->create(['ID_CLIENTE' => $cliente->ID_CLIENTE, 'TOTAL' => 500]);

        $response = $this->put(route('ventas.editar'), [
            'id_factura' => $factura->ID_FACTURA,
            'nombre_cliente' => 'Cliente Editado',
            'telefono_cliente' => '987654321',
            'correo_cliente' => 'editado@test.com',
            'producto' => 'Producto Test', 
            'total' => 1500,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('factura', ['ID_FACTURA' => $factura->ID_FACTURA, 'TOTAL' => 1500]);
    }

    public function test_caja_puede_finalizar_compra_desde_carrito()
    {
        $this->actingAsCaja();
        $producto = Producto::factory()->create(['CANTIDAD' => 10]);

        $payload = [
            'name' => 'Cliente Carrito',
            'id' => '99999999',
            'email' => 'carrito@test.com',
            'address' => 'Calle Carrito',
            'phone' => '5555555',
            'total' => 500,
            'cart' => [
                [
                    'ID_PRODUCTO' => $producto->ID_PRODUCTO,
                    'quantity' => 2,
                ]
            ]
        ];

        $response = $this->postJson(route('catalogo.finalizarCompra'), $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('clientes', ['NOMBRE_CLIENTE' => 'Cliente Carrito']);
        $this->assertDatabaseHas('factura', ['TOTAL' => 500]);
        $this->assertDatabaseHas('productos', [
            'ID_PRODUCTO' => $producto->ID_PRODUCTO,
            'CANTIDAD' => 8 // Se descuenta el stock
        ]);
    }
}