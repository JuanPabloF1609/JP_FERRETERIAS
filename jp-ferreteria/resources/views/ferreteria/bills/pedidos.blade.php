@extends('ferreteria.layouts.pedido_layout')

@section('content')
<div id="main-content" class="flex-1 transition-all duration-300 ease-in-out p-6 w-full ml-0">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Gestión de pedidos</h1>
        <!-- Botón flotante para iniciar tutorial -->
        <div class="floating-tutorial-btn" onclick="iniciarTutorial()">?</div>
        @can('view_bill')
        <div class="flex gap-4 mb-6 justify-center">
            <div data-intro="En esta sección puede consultar las estadísticas de los productos disponibles en el catálogo." data-step="1" class="flex-1 border border-gray-400 rounded-xl p-4 flex flex-col items-center shadow-md bg-white">
                <div class="text-green-600 text-3xl font-bold">{{ $productosEnCatalogo }}</div>
                <p class="font-semibold text-center">Productos en catálogo:</p>
            </div>
            <div data-intro="En esta sección puede consultar las estadísticas de las ventas finalizadas." data-step="2" class="flex-1 border border-gray-400 rounded-xl p-4 flex flex-col items-center shadow-md bg-white">
                <div class="text-red-600 text-3xl font-bold">{{ $ventasFinalizadas }}</div>
                <p class="font-semibold text-center">Ventas finalizadas:</p>
            </div>
        </div>

        <div class="flex items-center mb-4">
            <input type="text" id="search-input" class="flex-1 py-2 px-4 bg-[#D9D9D9] rounded-lg" placeholder="Buscar venta por nombre de cliente o ID">
            <button data-intro="Utilice este botón para buscar ventas por el nombre del cliente o el ID de la factura." data-step="3" id="search-button" class="bg-[#FF6200] text-white py-2 px-4 rounded ml-4 btn">Buscar</button>
        </div>

        <div class="overflow-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-center bg-[#D9D9D9]">
                        <th class="border border-black p-4">ID</th>
                        <th class="border border-black p-4">Nombre Cliente</th>
                        <th class="border border-black p-4">Teléfono</th>
                        <th class="border border-black p-4">Correo</th>
                        <th class="border border-black p-4">Producto</th>
                        <th class="border border-black p-4">Total</th>
                        <th class="border border-black p-4">Estado</th>
                        <th class="border border-black p-4">
                            @can('create_bill')
                                <button data-intro="Haga clic aquí para crear una nueva venta en el sistema." data-step="4" onclick="abrirModal()" class="bg-[#FF6200] text-white px-4 py-2 rounded btn">Crear Venta</button>
                            @endcan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                    <tr class="text-center bg-[#D9D9D9]">
                        <td class="border border-black p-4">{{ $venta->ID_FACTURA }}</td>
                        <td class="border border-black p-4">{{ $venta->cliente->NOMBRE_CLIENTE }}</td>
                        <td class="border border-black p-4">{{ $venta->cliente->TELEFONO_CLIENTE }}</td>
                        <td class="border border-black p-4">{{ $venta->cliente->CORREO_CLIENTE }}</td>
                        <td class="border border-black p-4">
                            {{ $venta->productos->pluck('NOMBRE_PRODUCTO')->join(', ') }}
                        </td>
                        <td class="border border-black p-4">${{ number_format($venta->TOTAL, 2) }}</td>
                        <td class="border border-black p-4">
                            <span class="{{ $venta->ESTADO === 'Inactivo' ? 'text-red-600 font-bold' : 'text-green-600 font-bold' }}">
                                {{ $venta->ESTADO ?? 'Activo' }}
                            </span>
                        </td>

                        <td class="border border-black p-4 space-x-2">
                            @can('edit_bill')
                                <button data-intro="Haga clic aquí para editar los detalles de una venta existente." data-step="5" onclick="abrirModalEditar({{ $venta }})" class="bg-blue-500 text-white px-6 py-3 rounded btn">Editar</button>
                            @endcan
                            @can('disable_bill')
                            <a href="{{ route('ventas.toggle', $venta->ID_FACTURA) }}" data-intro="Habilite o deshabilite una venta según sea necesario." data-step="6" class="px-6 py-3 rounded btn text-white 
                                {{ $venta->ESTADO === 'Activo' ? 'bg-gray-700' : 'bg-green-600' }}">
                                {{ $venta->ESTADO === 'Activo' ? 'Deshabilitar' : 'Habilitar' }}
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        @include('ferreteria.components.no_permission')
        @endcan  
              
    </div>
</div>

@include('ferreteria.components.pedido_modals')
@endsection

@can('view_caja_dashboard')
@section('scripts')
    @include('ferreteria.components.pedido_scripts')
@endsection
@endcan