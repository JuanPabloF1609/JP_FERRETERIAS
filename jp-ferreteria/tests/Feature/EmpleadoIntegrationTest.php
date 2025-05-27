<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpleadoIntegrationTest extends TestCase
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

    public function test_admin_puede_crear_empleado()
    {
        $this->actingAsAdmin();

        $response = $this->post(route('empleados.store'), [
            'name' => 'Empleado Test',
            'email' => 'empleado@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'estado' => 'activo',
            'role' => 'administrador', // Ajusta según tus roles
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['email' => 'empleado@test.com']);
    }

    public function test_admin_puede_editar_empleado()
    {
        $this->actingAsAdmin();
        $empleado = User::factory()->create(['name' => 'Original', 'email' => 'original@test.com', 'estado' => 'activo']);

        $response = $this->patch(route('empleados.update', $empleado->id), [
            'name' => 'Editado',
            'email' => 'editado@test.com',
            'estado' => 'activo',
            'role' => 'administrador', // Ajusta según tus roles
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $empleado->id, 'name' => 'Editado', 'email' => 'editado@test.com']);
    }

    public function test_admin_puede_deshabilitar_empleado()
    {
        $this->actingAsAdmin();
        $empleado = User::factory()->create(['estado' => 'activo']);

        $response = $this->patch(route('empleados.disable', $empleado->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $empleado->id, 'estado' => 'inactivo']);
    }
}