@extends('layouts.dashboard_delivery_layout')

@section('title', 'Dashboard Repartidor')

@section('content')
    @can('view_delivery_order')
        <div class="dashboard-container">
            <h1 class="dashboard-title">ORDENES</h1>
            <div class="dashboard-orders relative">
                @include('components.orden_activa')
                @include('components.orden_cola')
            </div>
            <!-- Botón de ayuda -->
            <button id="btn-ayuda" class="btn-ayuda">?</button>
        </div>
    @else
    <div class="no-permission-container">
            <h2 class="text-red-500 text-xl font-bold">Acceso Denegado</h2>
            <p class="text-gray-700">No tienes los permisos necesarios para acceder al historial de entregas.</p>
            <p class="text-gray-700">Si crees que esto es un error, contacta al administrador del sistema.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">Volver al Dashboard</a>
        </div>
    @endcan
@endsection