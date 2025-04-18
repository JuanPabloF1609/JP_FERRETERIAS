@extends('layouts.dashboard_delivery_layout')

@section('title', 'Historial de Entregas')

@section('content')
    @can('view_delivery_order')
        <div class="historico-container">
            <h1 class="historico-title">Historial de Entregas</h1>

            <div class="space-y-4">
                @for ($i = 0; $i < 3; $i++)
                    <div class="historico-item">
                        <p><strong>Nombre Cliente:</strong> Ejemplo Cliente {{ $i + 1 }}</p>
                        <p><strong>Dirección:</strong> Calle Ficticia {{ $i + 10 }}</p>
                        <p><strong>Productos:</strong> 4</p>
                        <p><strong>Viajes:</strong> 1</p>
                        <p><strong>Descripción:</strong> Cemento, tubos PVC, arena fina</p>
                        <p><strong>Fecha de entrega:</strong> {{ now()->subDays($i)->format('d/m/Y H:i') }}</p>
                    </div>
                @endfor
            </div>
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