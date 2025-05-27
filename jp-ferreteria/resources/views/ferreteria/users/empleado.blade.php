@extends('ferreteria.layouts.empleado_layout')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container">
    <h1>Gestión de empleados</h1>

   @can('view_users')
    @include('ferreteria.components.stats_emple') 
    @include('ferreteria.components.search_emple') 

    

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
                @forelse ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->name }}</td>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->roles->pluck('name')->join(', ') }}</td>
                        <td>{{ $empleado->estado ?? 'activo' }}</td>
                        <td>
                            <button 
                                class="btn-editar" 
                                onclick="abrirModalEditar({{ $empleado->id }})"
                                style="background-color: blue; color: white; border: 1px solid blue; padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                                Editar
                            </button>
                            @php
                                $colorClass = $empleado->estado === 'activo' ? 'btn-rojo' : 'btn-verde';
                            @endphp
                            <form method="POST" action="{{ route('empleados.disable', $empleado->id) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-deshabilitar {{ $colorClass }}">
                                    {{ $empleado->estado === 'activo' ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr id="sin-resultados">
                        <td colspan="5" class="py-4 text-gray-500">
                            No hay empleados registrados.
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
    @include('ferreteria.components.modalEmple')
@endsection

@section('scripts')
    @include('ferreteria.components.script_emple')
@endsection