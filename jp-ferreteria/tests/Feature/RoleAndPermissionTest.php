<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class RoleAndPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Ejecutar el seeder para roles y permisos
        $this->seed(\Database\Seeders\RoleAndPermissionSeeder::class);
    }

    public function test_super_admin_has_all_permissions()
    {
        $admin = User::factory()->create();
        $admin->assignRole('super_admin');

        $this->actingAs($admin);

        $this->assertTrue($admin->can('view_dashboard'));
        $this->assertTrue($admin->can('view_users'));
        $this->assertTrue($admin->can('create_products'));
    }

    public function test_caja_role_has_limited_permissions()
    {
        $caja = User::factory()->create();
        $caja->assignRole('caja');

        $this->actingAs($caja);

        $this->assertTrue($caja->can('view_dashboard'));
        $this->assertTrue($caja->can('view_bill'));
        $this->assertFalse($caja->can('create_users'));
    }

    public function test_domiciliario_role_has_specific_permissions()
    {
        $domiciliario = User::factory()->create();
        $domiciliario->assignRole('domiciliario');

        $this->actingAs($domiciliario);

        $this->assertTrue($domiciliario->can('view_delivery_order'));
        $this->assertTrue($domiciliario->can('create_delivery_order'));
        $this->assertFalse($domiciliario->can('view_users'));
    }
}