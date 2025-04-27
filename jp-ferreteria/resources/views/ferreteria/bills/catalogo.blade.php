@extends('ferreteria.layouts.catalogo_layout')

@section('content')

        <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold mb-6 text-center">Ventas</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @can('view_products')
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
                        @include('ferreteria.components.no_permission')
                    @endcan
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('ferreteria.components.catalogo_scripts')
@endsection