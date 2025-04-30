<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaIntegrationTest extends TestCase
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

    public function test_admin_puede_crear_categoria()
    {
        $this->actingAsAdmin();

        $response = $this->post(route('category.store'), [
            'NOMBRE_CATEGORIA' => 'Categoría Test',
            'DESCRIPCION' => 'Descripción test',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categorias', ['NOMBRE_CATEGORIA' => 'Categoría Test']);
    }

    public function test_admin_puede_editar_categoria()
    {
        $this->actingAsAdmin();
        $categoria = Categoria::factory()->create(['NOMBRE_CATEGORIA' => 'Original']);

        $response = $this->patch(route('category.update', $categoria->ID_CATEGORIA), [
            'NOMBRE_CATEGORIA' => 'Editada',
            'DESCRIPCION' => 'Nueva descripción',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categorias', ['NOMBRE_CATEGORIA' => 'Editada']);
    }

    public function test_admin_puede_deshabilitar_categoria()
    {
        $this->actingAsAdmin();
        $categoria = Categoria::factory()->create(['ESTADO' => 'activo']);

        $response = $this->patch(route('category.disable', $categoria->ID_CATEGORIA));
        $response->assertRedirect();
        $this->assertDatabaseHas('categorias', ['ID_CATEGORIA' => $categoria->ID_CATEGORIA, 'ESTADO' => 'inactivo']);
    }
}