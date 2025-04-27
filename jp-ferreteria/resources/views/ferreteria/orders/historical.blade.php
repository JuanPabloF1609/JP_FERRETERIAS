@extends('ferreteria.layouts.delivery_layout')

@section('title', 'Historial de Entregas')

@section('content')
    @can('view_delivery_dashboard')
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
        @include('ferreteria.components.no_permission')
    @endcan
@endsection