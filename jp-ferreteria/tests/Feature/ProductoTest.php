<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    
        // Crear permisos y roles
        Permission::create(['name' => 'create_products']);
        Permission::create(['name' => 'edit_products']);
        $adminRole = Role::create(['name' => 'administrador']);
        $adminRole->givePermissionTo(['create_products', 'edit_products']);
    }

    public function test_admin_puede_crear_producto(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        $this->actingAs($admin)
            ->post(route('admin.product.store'), [
                'NOMBRE_PRODUCTO' => 'Producto de prueba',
                'PRECIO' => 100.50,
                'CANTIDAD' => 10,
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('productos', [
            'NOMBRE_PRODUCTO' => 'Producto de prueba',
            'PRECIO' => 100.50,
            'CANTIDAD' => 10,
        ]);
    }

    public function test_usuario_sin_permiso_no_puede_crear_producto(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('admin.product.store'), [
                'NOMBRE_PRODUCTO' => 'Producto de prueba',
                'PRECIO' => 100.50,
                'CANTIDAD' => 10,
            ])
            ->assertStatus(403);

        $this->assertDatabaseMissing('productos', [
            'NOMBRE_PRODUCTO' => 'Producto de prueba',
        ]);
    }

    public function test_admin_puede_editar_producto(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('administrador');

        $producto = Producto::factory()->create([
            'NOMBRE_PRODUCTO' => 'Producto Original',
        ]);

        $this->actingAs($admin)
            ->put(route('admin.product.update', $producto), [
                'NOMBRE_PRODUCTO' => 'Producto Editado',
            ])
            ->assertStatus(200);

        $this->assertDatabaseHas('productos', [
            'NOMBRE_PRODUCTO' => 'Producto Editado',
        ]);
    }

    public function test_usuario_sin_permiso_no_puede_editar_producto(): void
    {
        $user = User::factory()->create();

        $producto = Producto::factory()->create([
            'NOMBRE_PRODUCTO' => 'Producto Original',
        ]);

        $this->actingAs($user)
            ->put(route('admin.product.update', $producto), [
                'NOMBRE_PRODUCTO' => 'Producto Editado',
            ])
            ->assertStatus(403);

        $this->assertDatabaseHas('productos', [
            'NOMBRE_PRODUCTO' => 'Producto Original',
        ]);
    }
}