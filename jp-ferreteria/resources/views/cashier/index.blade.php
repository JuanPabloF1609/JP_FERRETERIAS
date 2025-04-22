@extends('cashier.cashier_layout')

@section('content')
    @include('cashier.cashier_sidebar')

    <div id="main-content" class="flex-1 transition-all duration-300 ease-in-out p-6 w-full ml-0">
        <div class="mb-4">
            <button onclick="toggleSidebar()" class="text-black text-3xl focus:outline-none">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="3" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="3" width="16" height="6" fill="black"></rect>
                    <rect x="0" y="10" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="10" width="16" height="6" fill="black"></rect>
                    <rect x="0" y="17" width="6" height="6" fill="black"></rect>
                    <rect x="7" y="17" width="16" height="6" fill="black"></rect>
                </svg>
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-center">Ventas</h1>

            
                @can('view_products')
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @if (isset($productos) && !empty($productos))
                        @foreach ($productos as $producto)
                            <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                                <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}" class="w-32 h-32 object-cover mb-4 rounded">
                                <p class="text-sm font-semibold text-gray-700">Nombre: {{ $producto['nombre'] }}</p>
                                <p class="text-sm text-gray-600">Cantidad: {{ $producto['cantidad'] }}</p>
                                <p class="text-sm text-gray-600">Precio: {{ $producto['precio'] }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">No hay productos disponibles.</p>
                    @endif
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('cashier.cashier_scripts')
@endsection