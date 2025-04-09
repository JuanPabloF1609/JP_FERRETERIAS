<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductoPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar el seeder para roles y permisos
        $this->seed(\Database\Seeders\RoleAndPermissionSeeder::class);
    }

    public function test_super_admin_can_manage_products()
    {
        $admin = User::factory()->create();
        $admin->assignRole('super_admin');

        $producto = Producto::factory()->create();

        $this->actingAs($admin);

        $this->assertTrue($admin->can('view', $producto));
        $this->assertTrue($admin->can('create', Producto::class));
        $this->assertTrue($admin->can('update', $producto));
        $this->assertTrue($admin->can('delete', $producto));
    }

    public function test_caja_cannot_delete_products()
    {
        $caja = User::factory()->create();
        $caja->assignRole('caja');

        $producto = Producto::factory()->create();

        $this->actingAs($caja);

        $this->assertTrue($caja->can('view', $producto));
        $this->assertFalse($caja->can('delete', $producto));
    }
}