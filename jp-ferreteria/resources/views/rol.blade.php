@extends('layouts.base_Rol')

@section('title', 'Gestión de Roles')


@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Gestión de roles</h1>

    <!-- Tarjetas de estadísticas -->
    <div class="flex gap-6 mb-8">
        <!-- Tarjeta Roles Activos -->
        <div class="flex-1 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm p-5 flex items-center">
            <i class="fas fa-user-check text-green-500 text-2xl mr-4"></i>
            <div>
                <h2 class="text-sm font-medium text-gray-600">Roles activos:</h2>
                <p class="text-2xl font-bold text-green-600">{{ $RolesActivos }}</p>
            </div>
        </div>

        <!-- Tarjeta Roles Inactivos -->
        <div class="flex-1 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm p-5 flex items-center">
            <i class="fas fa-user-times text-red-500 text-2xl mr-4"></i>
            <div>
                <h2 class="text-sm font-medium text-gray-600">Roles inactivos:</h2>
                <p class="text-2xl font-bold text-red-600">{{ $RolesInactivos }}</p>
            </div>
        </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-6">
        <input type="text" id="searchInput" placeholder="Buscar rol por nombre o ID" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Tabla de roles -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permisos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-right">
                        <button onclick="mostrarModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors text-sm">
                            Crear rol
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($roles as $rol)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $rol['nombre'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rol['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rol['permisos'] ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($rol['activo'])
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="text-blue-500 hover:text-blue-700 mr-3">Editar</button>
                        <button class="text-red-500 hover:text-red-700">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('components.modal_Rol')
@endsection

@section('scripts')
    @include('components.scripts_rol')    
@endsection