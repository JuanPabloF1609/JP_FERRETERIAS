<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
            <i class="fas fa-shopping-cart text-white text-xl"></i>
        </div>
        <p class="value text-3xl font-bold text-gray-800">{{ $estadisticas['ventas_hoy'] ?? 0 }}</p>
        <p class="label text-sm text-gray-600">Ventas hoy</p>
    </div>
    <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
            <i class="fas fa-box-open text-white text-xl"></i>
        </div>
        <p class="value text-3xl font-bold text-gray-800">{{ $estadisticas['productos_vendidos'] ?? 0 }}</p>
        <p class="label text-sm text-gray-600">Productos vendidos</p>
    </div>
    <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
        </div>
        <p class="value text-3xl font-bold text-gray-800">{{ $estadisticas['inventario_bajo'] ?? 0 }}</p>
        <p class="label text-sm text-gray-600">Inventario bajo</p>
    </div>
    <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
            <i class="fas fa-users text-white text-xl"></i>
        </div>
        <p class="value text-3xl font-bold text-gray-800">{{ $estadisticas['clientes_nuevos'] ?? 0 }}</p>
        <p class="label text-sm text-gray-600">Clientes nuevos</p>
    </div>
</div>