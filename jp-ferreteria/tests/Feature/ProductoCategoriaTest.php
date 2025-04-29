<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductoCategoriaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    
        // Crear permisos y roles
        Permission::create(['name' => 'create_categories']);
        Permission::create(['name' => 'edit_categories']);
        Permission::create(['name' => 'create_products']);
        Permission::create(['name' => 'edit_products']);
        $adminRole = Role::create(['name' => 'administrador']);
        $adminRole->givePermissionTo(['create_categories', 'edit_categories', 'create_products', 'edit_products']);
    }

    public function test_admin_puede_crear_categoria_y_producto(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        // Crear categoría
        $this->actingAs($admin)
            ->post(route('admin.category.store'), [
                'NOMBRE_CATEGORIA' => 'Categoría de prueba',
            ])
            ->assertStatus(201);

        $categoria = Categoria::first();

        $this->assertDatabaseHas('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría de prueba',
        ]);

        // Crear producto asociado a la categoría
        $this->actingAs($admin)
            ->post(route('admin.product.store'), [
                'NOMBRE_PRODUCTO' => 'Producto de prueba',
                'PRECIO' => 100.50,
                'CANTIDAD' => 10,
                'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('productos', [
            'NOMBRE_PRODUCTO' => 'Producto de prueba',
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
        ]);
    }

    public function test_eliminar_categoria_elimina_productos_asociados(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        // Crear categoría
        $categoria = Categoria::factory()->create([
            'NOMBRE_CATEGORIA' => 'Categoría de prueba',
        ]);

        // Crear productos asociados a la categoría
        Producto::factory()->count(2)->create([
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
        ]);

        $this->assertCount(2, $categoria->productos);

        // Eliminar categoría
        $this->actingAs($admin)
            ->delete(route('admin.category.destroy', $categoria))
            ->assertStatus(200);

        $this->assertDatabaseMissing('categorias', [
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
        ]);

        $this->assertDatabaseMissing('productos', [
            'ID_CATEGORIA' => $categoria->ID_CATEGORIA,
        ]);
    }

    public function test_usuario_sin_permiso_no_puede_crear_categoria_ni_producto(): void
    {
        $user = User::factory()->create();

        // Intentar crear categoría
        $this->actingAs($user)
            ->post(route('admin.category.store'), [
                'NOMBRE_CATEGORIA' => 'Categoría de prueba',
            ])
            ->assertStatus(403);

        $this->assertDatabaseMissing('categorias', [
            'NOMBRE_CATEGORIA' => 'Categoría de prueba',
        ]);

        // Intentar crear producto
        $this->actingAs($user)
            ->post(route('admin.product.store'), [
                'NOMBRE_PRODUCTO' => 'Producto de prueba',
                'PRECIO' => 100.50,
                'CANTIDAD' => 10,
                'ID_CATEGORIA' => 1,
            ])
            ->assertStatus(403);

        $this->assertDatabaseMissing('productos', [
            'NOMBRE_PRODUCTO' => 'Producto de prueba',
        ]);
    }
}