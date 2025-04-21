 <!--Contiene los modales de creación y edición-->

<!-- Modal Crear Venta -->
<div id="modalVenta" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center">Crear Venta</h2>
        <form class="space-y-3">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="ID cliente">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Nombre del Cliente">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Dirección Cliente">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Sku/Código Producto">
            <input type="number" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Cantidad">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Precio">
            <div class="flex justify-center gap-6 pt-4">
                <button type="submit" class="bg-[#FF6200] text-white px-8 py-2 rounded btn">Crear</button>
                <button type="button" onclick="cerrarModal()" class="bg-[#FF0000] text-white px-8 py-2 rounded btn">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Venta -->
<div id="modalEditar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center">Editar Venta</h2>
        <form class="space-y-3">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="ID">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Nombre Cliente">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Productos">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Total">
            <input type="text" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Estado">
            <div class="flex justify-center gap-6 pt-4">
                <button type="submit" class="bg-[#FF6200] text-white px-8 py-2 rounded btn">Editar</button>
                <button type="button" onclick="cerrarModalEditar()" class="bg-[#FF0000] text-white px-8 py-2 rounded btn">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmación para deshabilitar -->
<div id="modalDeshabilitar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-30 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center text-red-600">Confirmar Deshabilitación</h2>
        <p class="text-gray-700 mb-6 text-center">
            ¿Estás seguro de que deseas deshabilitar esta venta? Esta acción no se puede deshacer.
        </p>
        <div class="flex justify-center gap-6">
            <button onclick="confirmarDeshabilitar()" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Confirmar
            </button>
            <button onclick="cerrarModalDeshabilitar()" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Cancelar
            </button>
        </div>
    </div>
</div>