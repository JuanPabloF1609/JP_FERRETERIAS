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
                <!-- Aquí irían los empleados dinámicos -->
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