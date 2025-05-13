<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = \App\Models\User::with('roles')->get();

        $estadisticas = [
            'activos' => $empleados->where('estado', 'activo')->count(),
            'inactivos' => $empleados->where('estado', 'inactivo')->count(),
        ];

        return view('ferreteria.users.empleado', compact('empleados', 'estadisticas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'estado' => 'required|in:activo,inactivo',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'estado' => $validated['estado'],
        ]);

        $user->assignRole($validated['role']);

        return redirect()->back()->with('success', 'Empleado creado correctamente.');
    }

    public function show($id)
    {
        $empleado = User::with('roles')->findOrFail($id);
        return response()->json([
            'id' => $empleado->id,
            'name' => $empleado->name,
            'email' => $empleado->email,
            'role' => $empleado->roles->pluck('name')->first(),
            'estado' => $empleado->estado,
        ]);
    }

    public function update(Request $request, $id)
    {
        $empleado = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|string|exists:roles,name',
            'estado' => 'required|in:activo,inactivo',
        ]);
        $empleado->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'estado' => $validated['estado'],
        ]);
        $empleado->syncRoles([$validated['role']]);
        return response()->json(['success' => true]);
    }

    public function disable($id)
    {
        $empleado = User::findOrFail($id);
        $empleado->estado = $empleado->estado === 'activo' ? 'inactivo' : 'activo';
        $empleado->save();
        return redirect()->back()->with('success', 'Estado del empleado actualizado exitosamente.');
    }
}