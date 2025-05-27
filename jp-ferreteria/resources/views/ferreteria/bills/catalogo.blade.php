@extends('ferreteria.layouts.catalogo_layout')

@section('content')
<div class="bg-gray-100 min-h-screen flex justify-center items-center">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-5xl mr-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Catálogo de Productos</h1>
            <input type="text" id="search-input" class="py-2 px-4 bg-gray-200 rounded-lg w-80" placeholder="Buscar producto por nombre">
        </div>

        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($productos as $producto)
            <div class="product-card relative bg-white rounded-lg shadow-lg p-4 flex flex-col items-center group" data-name="{{ strtolower($producto->NOMBRE_PRODUCTO) }}">
                <div class="w-full h-32 relative cursor-pointer overflow-hidden rounded" onclick="openProductDetailsModal({{ $producto->ID_PRODUCTO }})">
                    <!-- Ajustamos el fondo negro para que coincida con el tamaño de la imagen -->
                    <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                        <span class="text-white font-bold text-lg">Detalles</span>
                    </div>
                    <img src="{{ $producto->fotos->first()->url_foto ?? 'https://via.placeholder.com/150' }}" 
                         alt="{{ $producto->NOMBRE_PRODUCTO }}" 
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </div>
                <div class="w-full text-center">
                    <p class="text-sm font-semibold text-gray-700">Nombre: {{ $producto->NOMBRE_PRODUCTO }}</p>
                    <p class="text-sm text-gray-600" id="product-stock-{{ $producto->ID_PRODUCTO }}">
                        Cantidad: {{ $producto->CANTIDAD }}
                    </p>
                    <p class="text-sm text-gray-600">Precio: ${{ $producto->PRECIO }}</p>
                    <button onclick="addToCart({{ $producto->ID_PRODUCTO }})" 
                            class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Añadir al carrito
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('ferreteria.components.catalogo_product_modal')
@include('ferreteria.components.catalogo_cart')
@endsection

@section('scripts')
@include('ferreteria.components.catalogo_scripts')
@endsection