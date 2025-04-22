@extends('layouts.base_emple')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold text-center mb-6">Gestión de empleados</h1>

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
    <div class="flex items-center justify-center bg-gray-100 w-full h-[500px] rounded-xl shadow-inner">
        <div class="bg-white p-8 rounded-xl shadow-2xl text-center max-w-md w-full">
            <h2 class="text-red-600 text-2xl font-bold mb-4">Acceso Denegado</h2>
            <p class="text-gray-700 mb-2">No tienes los permisos necesarios para acceder al historial de entregas.</p>
            <p class="text-gray-700 mb-6">Si crees que esto es un error, contacta al administrador del sistema.</p>
            <a href="{{ route('dashboard') }}"
               class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
               Volver al Dashboard
            </a>
        </div>
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