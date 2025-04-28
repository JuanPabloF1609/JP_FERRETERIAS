<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permissions = [
            'view_admin_dashboard', 'view_caja_dashboard', 'view_delivery_dashboard',
            'view_users', 'create_users', 'edit_users', 'disable_users',
            'view_products', 'create_products', 'edit_products', 'disable_products',
            'view_categories', 'create_categories', 'edit categories', 'disable_categories',
            'view_delivery_order', 'create_delivery_order', 'edit_delivery_order', 'disable_delivery_order',
            'view_bill', 'create_bill', 'edit_bill', 'disable_bill',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $roleAdmin = Role::firstOrCreate(['name' => 'administrador']);
        $roleCaja = Role::firstOrCreate(['name' => 'caja']);
        $roleDomiciliario = Role::firstOrCreate(['name' => 'domiciliario']);

        // Asignar todos los permisos al rol admin
        $roleAdmin->syncPermissions([
            'view_admin_dashboard',
            'view_users', 'create_users', 'edit_users', 'disable_users',
            'view_products', 'create_products', 'edit_products', 'disable_products',
            'view_categories', 'create_categories', 'edit categories', 'disable_categories',
        ]);

        // Asignar permisos al rol caja
        $roleCaja->syncPermissions([
            'view_caja_dashboard',
            'view_bill', 'create_bill', 'edit_bill', 'disable_bill',
            'view_categories',
            'view_products',
            'view_delivery_order',
        ]);

        // Asignar permisos al rol domiciliario
        $roleDomiciliario->syncPermissions([
            'view_delivery_dashboard',
            'view_bill',
            'view_delivery_order', 'create_delivery_order', 'edit_delivery_order', 'disable_delivery_order',
        ]);

        // Crear usuarios y asignar roles
        $adminUser = User::query()->create([
            'first_name' => 'Carlos',
            'second_name' => 'Andrés',
            'first_surname' => 'Gómez',
            'second_surname' => 'Rodríguez',
            'name' => 'Carlos Andrés Gómez Rodríguez',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Password'),
            'email_verified_at' => true, // Equivalente a email_verified_at
            'status' => 'active',
        ]);
        $adminUser->assignRole($roleAdmin);

        $cajaUser = User::query()->create([
            'first_name' => 'María',
            'second_name' => null,
            'first_surname' => 'López',
            'second_surname' => 'Pérez',
            'name' => 'María López Pérez',
            'email' => 'caja@caja.com',
            'password' => bcrypt('Password'),
            'email_verified_at' => true,
            'status' => 'active',
        ]);
        $cajaUser->assignRole($roleCaja);

        $domiciliarioUser = User::query()->create([
            'first_name' => 'Juan',
            'second_name' => 'David',
            'first_surname' => 'Martínez',
            'second_surname' => null,
            'name' => 'Juan David Martínez',
            'email' => 'domi@domi.com',
            'password' => bcrypt('Password'),
            'email_verified_at' => true,
            'status' => 'active',
        ]);
        $domiciliarioUser->assignRole($roleDomiciliario);
    }
}