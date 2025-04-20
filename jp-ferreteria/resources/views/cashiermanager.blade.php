@extends('cashier_layout')

@section('content')
    @include('cashier_sidebar')

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
            <h1 class="text-2xl font-bold mb-6 text-center">Gestión de ventas</h1>
            @can('view_bill')
            <div class="flex gap-4 mb-6 justify-center">
                <div class="flex-1 border border-gray-400 rounded-xl p-4 flex flex-col items-center shadow-md bg-white">
                    <div class="text-green-600 text-3xl font-bold">$$</div>
                    <p class="font-semibold text-center">Ventas activas:</p>
                    <p class="text-xl font-bold">12</p>
                </div>
                <div class="flex-1 border border-gray-400 rounded-xl p-4 flex flex-col items-center shadow-md bg-white">
                    <div class="text-red-600 text-3xl font-bold">$</div>
                    <p class="font-semibold text-center">Ventas finalizadas:</p>
                    <p class="text-xl font-bold">3</p>
                </div>
            </div>


            <div class="flex items-center mb-4">
                <input type="text" class="flex-1 py-2 px-4 bg-[#D9D9D9] rounded-lg" placeholder="Buscar venta por nombre de cliente o ID">

                    <button data-intro="buscar" class="bg-[#FF6200] text-white py-2 px-4 rounded ml-4 btn">Buscar</button>

            </div>

            <div class="overflow-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-center bg-[#D9D9D9]">
                            <th class="border border-black p-4">ID</th>
                            <th class="border border-black p-4">Nombre Cliente</th>
                            <th class="border border-black p-4">Productos</th>
                            <th class="border border-black p-4">Total</th>
                            <th class="border border-black p-4">Estado</th>
                            <th class="border border-black p-4">
                                @can('create_bill')
                                    <button data-intro="crear-venta" onclick="abrirModal()" class="bg-[#FF6200] text-white px-4 py-2 rounded btn">Crear Venta</button>
                                @endcan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center bg-[#D9D9D9]">
                            <td class="border border-black p-4">E0115</td>
                            <td class="border border-black p-4">Juan Perez</td>
                            <td class="border border-black p-4">Algo</td>
                            <td class="border border-black p-4">$350.000</td>
                            <td class="border border-black p-4">Activo</td>
                            <td class="border border-black p-4 space-x-2">
                                @can('edit_bill')
                                    <button data-intro="editar" onclick="abrirModalEditar()" class="bg-blue-500 text-white px-6 py-3 rounded btn">Editar</button>
                                @endcan
                                @can('disable_bill')
                                    <button data-intro="deshabilitar" onclick="deshabilitarVenta()" class="bg-gray-700 text-white px-6 py-3 rounded btn">Deshabilitar</button>
                                @endcan
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            @include('components.no_permission')
            @endcan        
        </div>
    </div>

    @include('cashier_modals')
@endsection
@can('view_caja_dashboard')
@section('scripts')
    @include('cashier_scripts')
@endsection
@endcan