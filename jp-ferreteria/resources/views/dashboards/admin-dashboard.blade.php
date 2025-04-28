<x-layouts.app :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 ">Panel de Administrador</h1>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-2">
            <!-- Total de Ventas -->
            <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 ">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500">
                    <x-heroicon-o-currency-dollar class="h-6 w-6 text-white" />
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-800 ">{{ $totalVentas }}</p>
                    <p class="text-sm text-gray-600 ">Ventas Totales</p>
                </div>
            </div>
            <!-- Productos Vendidos -->
            <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 ">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500">
                    <x-heroicon-o-cube class="h-6 w-6 text-white" />
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-800 ">{{ $totalProductosVendidos }}</p>
                    <p class="text-sm text-gray-600 ">Productos Vendidos</p>
                </div>
            </div>
            <!-- Inventario Bajo -->
            <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 ">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500">
                    <x-heroicon-o-archive-box class="h-6 w-6 text-white" />
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-800 ">{{ $inventarioBajo }}</p>
                    <p class="text-sm text-gray-600 ">Inventario Bajo</p>
                </div>
            </div>
            <!-- Usuarios Registrados -->
            <div class="flex items-center gap-4 rounded-xl border border-neutral-200 bg-white p-4 ">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-orange-500">
                    <x-heroicon-o-users class="h-6 w-6 text-white" />
                </div>
                <div>
                    <p class="text-3xl font-bold text-gray-800 ">{{ $usuariosRegistrados }}</p>
                    <p class="text-sm text-gray-600 ">Usuarios Registrados</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>