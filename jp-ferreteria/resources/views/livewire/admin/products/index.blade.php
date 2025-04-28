<x-layouts.app :title="__('Products')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Productos</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Productos Totales</h2>
                <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver el total de productos registrados.</p>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Crear Producto</h2>
                <p class="text-gray-600 dark:text-gray-400">Añade un nuevo producto al sistema.</p>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Filtrar Productos</h2>
                <p class="text-gray-600 dark:text-gray-400">Busca productos por categoría o estado.</p>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Lista de Productos</h2>
            <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver y gestionar todos los productos.</p>
        </div>
    </div>
</x-layouts.app>