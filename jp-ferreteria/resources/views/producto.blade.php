@extends('layouts.base')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold text-center mb-6">Gestión de productos</h1>
    @can('view_products')
    @include('components.stats_product')
    @include('components.search_admin')



    <!-- Tabla -->
    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>CATEGORÍA</th>
                    <th>ESTADO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>
                        @can('create_product')
                            <button data-intro="crear-producto" onclick="mostrarFormulario()" class="btn-crear">Crear producto</button>
                        <button onclick="mostrarFormulario()" class="btn-crear">Crear producto</button>
                        @endcan
                    </th>
                </tr>
            </thead>
            <tbody id="productos-container">
                <tr id="sin-resultados" style="display: none;">
                    <td colspan="7" class="py-4 text-gray-500">
                        Ingrese un término de búsqueda para mostrar productos
                    </td>
                </tr>
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
    @include('components.modal_produ')
@endsection

@section('scripts')
    @include('components.scripts_produ')
@endsection