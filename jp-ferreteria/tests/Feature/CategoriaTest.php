<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    
        // Crear permisos y roles
        Permission::create(['name' => 'create_categories']);
        Permission::create(['name' => 'edit_categories']);
        $adminRole = Role::create(['name' => 'administrador']);
        $adminRole->givePermissionTo(['create_categories', 'edit_categories']);
    }

    public function test_admin_puede_crear_categoria(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        $this->actingAs($admin)
            ->post(route('admin.category.store'), [
                'NOMBRE_CATEGORIA' => 'Categoría de prueba',
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría de prueba',
        ]);
    }

    public function test_usuario_sin_permiso_no_puede_crear_categoria(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.category.store'), [
                'NOMBRE_CATEGORIA' => 'Categoría de prueba',
            ])
            ->assertStatus(403);

        $this->assertDatabaseMissing('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría de prueba',
        ]);
    }

    public function test_admin_puede_editar_categoria(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        $categoria = Categoria::factory()->create([
            'NOMBRE_CATEGORIA' => 'Categoría Original',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.category.update', $categoria), [
                'NOMBRE_CATEGORIA' => 'Categoría Editada',
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría Editada',
        ]);
    }

    public function test_usuario_sin_permiso_no_puede_editar_categoria(): void
    {
        $user = User::factory()->create();

        $categoria = Categoria::factory()->create([
            'NOMBRE_CATEGORIA' => 'Categoría Original',
        ]);

        $this->actingAs($user)
            ->put(route('admin.category.update', $categoria), [
                'NOMBRE_CATEGORIA' => 'Categoría Editada',
            ])
            ->assertStatus(403);

        $this->assertDatabaseHas('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría Original',
        ]);
    }
}