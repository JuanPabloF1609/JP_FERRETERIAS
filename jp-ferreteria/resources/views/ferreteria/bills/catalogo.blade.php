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
                <div class="w-full h-32 relative cursor-pointer overflow-hidden rounded" onclick="openProductDetailsModal({{ json_encode($producto) }})">
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
                    <p class="text-sm text-gray-600">Cantidad: {{ $producto->CANTIDAD }}</p>
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

<!-- Modal de detalles del producto -->
<div id="product-details-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" onclick="closeProductDetailsModal()">
    <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto p-6" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center border-b pb-4">
            <h3 id="modal-product-name" class="text-xl font-bold">Detalles del Producto</h3>
        </div>
        <div class="flex mt-4 gap-6">
            <!-- Carrusel vertical de miniaturas -->
            <div class="w-1/6 overflow-y-auto flex flex-col gap-2">
                <div id="modal-product-thumbnails" class="flex flex-col gap-2">
                    <!-- Miniaturas dinámicas -->
                </div>
            </div>
            <!-- Fotos principales del producto -->
            <div class="w-1/3">
                <div id="modal-product-images" class="grid grid-cols-1 gap-4">
                    <!-- Imagen principal dinámica -->
                </div>
            </div>
            <!-- Información del producto -->
            <div class="w-1/2">
                <p id="modal-product-description" class="text-gray-700 mb-4">Descripción del producto.</p>
                <p id="modal-product-price" class="text-lg font-bold text-blue-600">Precio: $0.00</p>
                <p id="modal-product-stock" class="text-sm text-gray-600">Cantidad disponible: 0</p>
                <p id="modal-product-reference" class="text-sm text-gray-600">Referencia: N/A</p>
            </div>
        </div>
        <div class="border-t pt-4 flex justify-end">
            <button id="add-to-cart-modal-btn" onclick="addToCartFromModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Añadir al carrito
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('ferreteria.components.catalogo_scripts')
@endsection