@extends('ferreteria.layouts.catalogo_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Lista de Productos</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($productos as $producto)
            <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
                <img src="{{ $producto->imagen ?? 'https://via.placeholder.com/150' }}" alt="{{ $producto->NOMBRE_PRODUCTO }}" class="w-32 h-32 object-cover mb-4 rounded">
                <p class="text-sm font-semibold text-gray-700">Nombre: {{ $producto->NOMBRE_PRODUCTO }}</p>
                <p class="text-sm text-gray-600">Cantidad: {{ $producto->CANTIDAD }}</p>
                <p class="text-sm text-gray-600">Precio: ${{ $producto->PRECIO }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
