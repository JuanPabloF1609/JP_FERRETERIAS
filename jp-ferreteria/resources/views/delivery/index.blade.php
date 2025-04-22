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
            <button id="btn-ayuda" class="btn-ayuda text-2xl w-12 h-12">?</button>
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

@endsection