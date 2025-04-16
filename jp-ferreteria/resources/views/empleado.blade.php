@extends('layouts.base_emple')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container">
    <h1>Gestión de empleados</h1>

   @can('view_users')
    @include('components.stats_emple') 
    @include('components.search_emple') 

    

    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>ID</th>
                    <th>ROL</th>
                    <th>ESTADO</th>
                    <th>
                        <button onclick="mostrarFormulario()" class="btn-crear">Crear empleado</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irían los empleados dinámicos -->
            </tbody>
        </table>
    </div>
    @else
        <div class="no-permission-container">
            <h2 class="text-red-500 text-xl font-bold">Acceso Denegado</h2>
            <p class="text-gray-700">No tienes los permisos necesarios para acceder al historial de entregas.</p>
            <p class="text-gray-700">Si crees que esto es un error, contacta al administrador del sistema.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Volver al Dashboard</a>
        </div>
    @endcan
</div>
@endsection

@section('modals')
    @include('components.modalEmple')
@endsection

@section('scripts')
    @include('components.script_emple')
@endsection