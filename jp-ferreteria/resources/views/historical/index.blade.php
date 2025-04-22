@extends('layouts.dashboard_delivery_layout')

@section('title', 'Historial de Entregas')

@section('content')
    @can('view_delivery_order')
        <div class="flex items-center justify-center bg-gray-100 px-4 py-8 min-h-[700px]">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-4xl h-[550px] flex flex-col justify-center overflow-hidden">
                <h1 class="text-3xl font-bold text-center text-[#1F2937] mb-6">Historial de Entregas</h1>

                <div class="overflow-x-auto">
                    <div class="flex space-x-6 snap-x snap-mandatory pl-4 pr-2">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="min-w-[340px] bg-gray-200 p-6 rounded-2xl shadow-lg snap-start flex-shrink-0 transition-transform duration-300 hover:scale-105 text-left">
                                <h2 class="text-xl font-semibold text-[#374151] mb-3">Cliente {{ $i + 1 }}</h2>
                                <p class="text-base text-gray-700"><strong>Dirección:</strong> Calle Ficticia {{ $i + 10 }}</p>
                                <p class="text-base text-gray-700"><strong>Productos:</strong> 4</p>
                                <p class="text-base text-gray-700"><strong>Viajes:</strong> 1</p>
                                <p class="text-base text-gray-700"><strong>Descripción:</strong> Cemento, tubos PVC, arena fina</p>
                                <p class="text-sm text-gray-600 mt-2"><strong>Entregado:</strong> {{ now()->subDays($i)->format('d/m/Y H:i') }}</p>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
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
