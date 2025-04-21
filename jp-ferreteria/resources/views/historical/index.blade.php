@extends('layouts.dashboard_delivery_layout')

@section('title', 'Historial de Entregas')

@section('content')
    @can('view_delivery_order')
        <div class="historico-container">
            <!-- Encabezado -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="historico-title">Historial de Entregas</h1>
                    <p class="text-gray-600">Consulta las entregas realizadas recientemente.</p>
                </div>
            </div>

            <!-- Filtro de búsqueda -->
            <div class="mb-6">
                <input
                    type="text"
                    class="w-full p-2 border rounded"
                    placeholder="Buscar por cliente, dirección o fecha"
                />
            </div>

            <!-- Lista de entregas -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <article class="historico-item">
                        <h2 class="text-lg font-bold mb-2">Entrega #{{ $i + 1 }}</h2>
                        <p><strong>Nombre Cliente:</strong> Ejemplo Cliente {{ $i + 1 }}</p>
                        <p><strong>Dirección:</strong> Calle Ficticia {{ $i + 10 }}</p>
                        <p><strong>Productos:</strong> 4</p>
                        <p><strong>Viajes:</strong> 1</p>
                        <p><strong>Descripción:</strong> Cemento, tubos PVC, arena fina</p>
                        <p><strong>Fecha de entrega:</strong> {{ now()->subDays($i)->format('d/m/Y H:i') }}</p>
                    </article>
                @endfor
            </section>

            <!-- Paginación -->
            <div class="historico-pagination mt-6">
                <nav aria-label="Paginación de entregas">
                    <ul class="inline-flex items-center space-x-2">
                        <li><a href="#" class="px-3 py-1 border rounded hover:bg-gray-200">Anterior</a></li>
                        <li><a href="#" class="px-3 py-1 border rounded hover:bg-gray-200">1</a></li>
                        <li><a href="#" class="px-3 py-1 border rounded hover:bg-gray-200">2</a></li>
                        <li><a href="#" class="px-3 py-1 border rounded hover:bg-gray-200">Siguiente</a></li>
                    </ul>
                </nav>
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
