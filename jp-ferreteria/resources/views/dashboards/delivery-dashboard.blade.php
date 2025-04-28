<x-layouts.app :title="__('Delivery Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Panel de Domiciliario</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Pedidos de Entrega -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pedidos de Entrega</h2>
                <p class="text-gray-600 dark:text-gray-400">Gestiona los pedidos de entrega asignados.</p>
            </div>
            <!-- Facturas -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Facturas</h2>
                <p class="text-gray-600 dark:text-gray-400">Consulta las facturas relacionadas con tus entregas.</p>
            </div>
            <!-- Estado de Entregas -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Estado de Entregas</h2>
                <p class="text-gray-600 dark:text-gray-400">Revisa el estado de tus entregas.</p>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Rutas de Entrega</h2>
            <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver las rutas asignadas para tus entregas.</p>
        </div>
    </div>
</x-layouts.app>