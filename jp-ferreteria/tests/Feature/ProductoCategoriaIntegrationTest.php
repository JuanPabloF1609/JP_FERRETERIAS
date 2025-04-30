<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoCategoriaIntegrationTest extends TestCase
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

    public function test_crear_producto_y_verificar_categoria()
    {
        $this->actingAsAdmin();
        $categoria = Categoria::factory()->create(['NOMBRE_CATEGORIA' => 'Categoría Relación']);

        $producto = Producto::factory()->create([
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
            'NOMBRE_PRODUCTO' => 'Producto Relacionado'
        ]);

        $this->assertEquals($categoria->ID_CATEGORIA, $producto->ID_CATEGORIA);
        $this->assertEquals('Categoría Relación', $producto->categoria->NOMBRE_CATEGORIA);
    }

    public function test_editar_producto_y_verificar_categoria()
    {
        $this->actingAsAdmin();
        $categoria1 = Categoria::factory()->create(['NOMBRE_CATEGORIA' => 'Cat 1']);
        $categoria2 = Categoria::factory()->create(['NOMBRE_CATEGORIA' => 'Cat 2']);

        $producto = Producto::factory()->create([
            'ID_CATEGORIA' => $categoria1->ID_CATEGORIA,
            'NOMBRE_PRODUCTO' => 'Producto Editar'
        ]);

        $producto->update(['ID_CATEGORIA' => $categoria2->ID_CATEGORIA, 'NOMBRE_PRODUCTO' => 'Producto Editado']);

        $producto->refresh();
        $this->assertEquals($categoria2->ID_CATEGORIA, $producto->ID_CATEGORIA);
        $this->assertEquals('Cat 2', $producto->categoria->NOMBRE_CATEGORIA);
        $this->assertEquals('Producto Editado', $producto->NOMBRE_PRODUCTO);
    }
}