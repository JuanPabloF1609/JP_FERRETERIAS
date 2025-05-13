@extends('ferreteria.layouts.delivery_layout')

@section('title', 'Dashboard Repartidor')

@section('content')
    @can('view_delivery_dashboard')
        <div class="dashboard-container">
            <h1 class="dashboard-title">ORDENES</h1>
            <div class="dashboard-orders relative">
                @include('ferreteria.components.orden_activa', ['orden' => $ordenActiva])
                @include('ferreteria.components.orden_cola', ['ordenes' => $ordenesCola])
            </div>
            <!-- Botón de ayuda -->
            <button id="btn-ayuda" class="btn-ayuda">?</button>
        </div>
    @else
        @include('ferreteria.components.no_permission')
    @endcan
@endsection