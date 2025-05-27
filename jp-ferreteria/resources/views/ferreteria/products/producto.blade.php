@extends('ferreteria.layouts.productos_layout')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container">
    <h1>Gestión de productos</h1>

    @can('view_products')
    @include('ferreteria.components.stats_product')
    
    @include('ferreteria.components.search_admin')



    <!-- Tabla -->
    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>CATEGORÍA</th>
                    <th>DESCRIPCION</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>ESTADO</th> <!-- NUEVA COLUMNA -->
                    <th>
                    @can('create_products')
                        <button data-intro="crear-producto" onclick="mostrarFormulario()" class="btn-crear">Crear producto</button>
                    @endcan
                    </th>
                </tr>
            </thead>
            <tbody id="productos-container">
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto->ID_PRODUCTO }}</td>
                        <td>{{ $producto->NOMBRE_PRODUCTO }}</td>
                        <td>{{ $producto->categoria->NOMBRE_CATEGORIA ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->DESCRIPCION }}</td>
                        <td>{{ $producto->CANTIDAD }}</td>
                        <td>{{ $producto->PRECIO }}</td>
                        <td>
                            <span class="{{ $producto->ESTADO === 'inactivo' ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                                {{ ucfirst($producto->ESTADO) }}
                            </span>
                        </td>
                        <td>
                            <!-- Botón Editar -->
                            <button onclick="abrirModalEditar({{ $producto->ID_PRODUCTO }})" class="btn-editar bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Editar
                            </button>

                            <!-- Botón de estado -->
                            <button 
                                class="btn-toggle-estado {{ $producto->ESTADO === 'activo' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-4 py-2 rounded"
                                data-id="{{ $producto->ID_PRODUCTO }}"
                                data-estado="{{ $producto->ESTADO }}"
                                onclick="toggleProductStatus({{ $producto->ID_PRODUCTO }}, this)">
                                {{ $producto->ESTADO === 'activo' ? 'Deshabilitar' : 'Habilitar' }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr id="sin-resultados">
                        <td colspan="8" class="py-4 text-gray-500">
                            No hay productos disponibles.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @else
        @include('ferreteria.components.no_permission')
    @endcan
</div>
@endsection

@section('modals')
    @include('ferreteria.components.modal_produ')
@endsection

@section('scripts')
    @include('ferreteria.components.scripts_produ')
@endsection