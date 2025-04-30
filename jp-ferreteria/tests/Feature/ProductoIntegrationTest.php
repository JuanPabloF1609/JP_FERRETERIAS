<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductoIntegrationTest extends TestCase
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

    public function test_admin_puede_crear_producto()
    {
        $this->actingAsAdmin();
        $categoria = Categoria::factory()->create();

        Storage::fake('public');
        $response = $this->post(route('productos.store'), [
            'NOMBRE_PRODUCTO' => 'Producto Test',
            'PRECIO' => 100,
            'CANTIDAD' => 10,
            'STOCK_MINIMO' => 2,
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
            'REFERENCIA' => 'REF-001',
            'DESCRIPCION' => 'Descripción test',
            'fotos' => [UploadedFile::fake()->image('foto.jpg')],
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('productos', ['NOMBRE_PRODUCTO' => 'Producto Test']);
    }

    public function test_admin_puede_editar_producto()
    {
        $this->actingAsAdmin();
        $producto = Producto::factory()->create(['NOMBRE_PRODUCTO' => 'Original']);

        $response = $this->put("/productos/{$producto->ID_PRODUCTO}", [
            'NOMBRE_PRODUCTO' => 'Editado',
            'PRECIO' => 200,
            'CANTIDAD' => 5,
            'STOCK_MINIMO' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('productos', ['NOMBRE_PRODUCTO' => 'Editado']);
    }

    public function test_admin_puede_deshabilitar_producto()
    {
        $this->actingAsAdmin();
        $producto = Producto::factory()->create(['activo' => true]);

        $response = $this->put(route('productos.disable', $producto->ID_PRODUCTO));
        $response->assertRedirect();
        $this->assertDatabaseHas('productos', ['ID_PRODUCTO' => $producto->ID_PRODUCTO, 'activo' => false]);
    }
}