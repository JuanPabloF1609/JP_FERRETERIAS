<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = [
            [
                'id' => 1, 
                'nombre' => 'Administrador', 
                'descripcion' => 'Acceso total al sistema', 
                'permisos' => 'Todos', 
                'activo' => true, // Añadido campo activo
                'created_at' => now()
            ],
            [
                'id' => 2, 
                'nombre' => 'Editor', 
                'descripcion' => 'Puede editar contenidos', 
                'permisos' => 'Editar, Crear', 
                'activo' => true, // Añadido campo activo
                'created_at' => now()
            ],
        ];

        // Calcular roles activos e inactivos
        $RolesActivos = count(array_filter($roles, function($role) {
            return $role['activo'] === true;
        }));
        
        $RolesInactivos = count($roles) - $RolesActivos;

        return view('rol', compact('roles', 'RolesActivos', 'RolesInactivos'));
    }
}