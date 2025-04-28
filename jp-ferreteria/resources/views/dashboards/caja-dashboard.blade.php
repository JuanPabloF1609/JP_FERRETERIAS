<x-layouts.app :title="__('Caja Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Panel de Caja</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Facturas -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Facturas</h2>
                <p class="text-gray-600 dark:text-gray-400">Crea y gestiona facturas.</p>
            </div>
            <!-- Productos -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Productos</h2>
                <p class="text-gray-600 dark:text-gray-400">Consulta los productos disponibles.</p>
            </div>
            <!-- Pedidos de Entrega -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pedidos de Entrega</h2>
                <p class="text-gray-600 dark:text-gray-400">Revisa los pedidos de entrega.</p>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Resumen de Ventas</h2>
            <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver un resumen de las ventas del día.</p>
        </div>
    </div>
</x-layouts.app>