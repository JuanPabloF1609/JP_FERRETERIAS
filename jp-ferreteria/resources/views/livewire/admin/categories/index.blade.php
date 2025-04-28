<x-layouts.app :title="__('Categories')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Categorías</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Categorías Totales</h2>
                <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver el total de categorías registradas.</p>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Crear Categoría</h2>
                <p class="text-gray-600 dark:text-gray-400">Añade una nueva categoría al sistema.</p>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Filtrar Categorías</h2>
                <p class="text-gray-600 dark:text-gray-400">Busca categorías por nombre o estado.</p>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Lista de Categorías</h2>
            <p class="text-gray-600 dark:text-gray-400">Aquí puedes ver y gestionar todas las categorías.</p>
        </div>
    </div>
</x-layouts.app>