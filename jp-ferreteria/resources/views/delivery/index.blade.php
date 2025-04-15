@extends('layouts.dashboard_delivery_layout')

@section('title', 'Dashboard Repartidor')

@section('content')
    <div class="dashboard-container">
        <h1 class="dashboard-title">ORDENES</h1>
        <div class="dashboard-orders relative">
            @include('components.orden_activa')
            @include('components.orden_cola')
            
        </div>
            <!-- Botón de ayuda -->
            <button id="btn-ayuda" class="btn-ayuda">?</button>
    </div>
@endsection

