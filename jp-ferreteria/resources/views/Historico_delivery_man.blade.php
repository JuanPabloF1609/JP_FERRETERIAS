@extends('layouts.dashboard_delivery_layout')

@section('title', 'Historial de Entregas')

@section('content')
    <div class="bg-white w-[900px] rounded-[10px] p-6 shadow-md overflow-auto mt-10">
        <h1 class="text-center text-xl font-bold mb-6">Historial de Entregas</h1>

        <div class="space-y-4">
            @for ($i = 0; $i < 3; $i++)
                <div class="border rounded p-4 bg-zinc-100">
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
@endsection
