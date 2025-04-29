@extends('ferreteria.layouts.category_layout')

@section('title', 'Gestión de Categoria')

@section('content')
<div class="container" style="overflow: auto; max-height: 100%; padding: 20px; box-sizing: border-box;">
    <h1>Gestión de categoria</h1>

    @can('view_products')
    @include('ferreteria.components.stats_category')
    
    @include('ferreteria.components.search_admin')

    <!-- Tabla -->
    <div class="table-section" style="overflow-x: auto; max-width: 100%;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE CATEGORÍA</th>
                    <th>DESCRIPCIÓN</th>
                    <th>
                        @can('create_products')
                            <button data-intro="crear-categoria" onclick="mostrarFormulario()" class="btn-crear">Crear categoría</button>
                        @endcan
                    </th>
                </tr>
            </thead>
            <tbody id="productos-container">
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->ID_CATEGORIA }}</td>
                        <td>{{ $categoria->NOMBRE_CATEGORIA }}</td>
                        <td>{{ $categoria->DESCRIPCION }}</td>
                        <td>
                            <button 
                                class="btn-editar" 
                                data-id="{{ $categoria->ID_CATEGORIA }}" 
                                data-nombre="{{ $categoria->NOMBRE_CATEGORIA }}" 
                                data-descripcion="{{ $categoria->DESCRIPCION }}" 
                                style="background-color: blue; color: white; border: 1px solid blue; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                                Editar
                            </button>
                            <form method="POST" action="{{ route('category.disable', $categoria->ID_CATEGORIA) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="btn-deshabilitar" 
                                        style="background-color: red; color: white; border: 1px solid red; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                                    Deshabilitar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr id="sin-resultados">
                        <td colspan="4" class="py-4 text-gray-500">
                            No hay categorías registradas.
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
    @include('ferreteria.components.modal_category')
@endsection

@section('scripts')
    @include('ferreteria.components.scripts_category')
@endsection