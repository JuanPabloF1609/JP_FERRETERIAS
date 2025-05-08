<!--Contiene los modales de creación y edición-->

<!-- Modal Crear Venta -->
<div id="modalVenta" class="fixed inset-0 flex items-center justify-center z-30 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center">Crear Venta</h2>
        <form id="crearVentaForm" class="space-y-3" method="POST" action="{{ route('ventas.crear') }}">
            @csrf
            <input type="text" name="nombre_cliente" id="nombre_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Nombre del Cliente" required>
            <input type="text" name="direccion_cliente" id="direccion_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Dirección del Cliente" required>
            <input type="text" name="telefono_cliente" id="telefono_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Teléfono del Cliente" required>
            <input type="email" name="correo_cliente" id="correo_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Correo del Cliente" required>
            <input type="text" name="identificacion_cliente" id="identificacion_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Identificación del Cliente" required>
            <input type="text" name="producto" id="producto" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Producto" required>
            <input type="number" name="total" id="total" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Total" required>
            <div class="flex justify-center gap-6 pt-4">
                <button type="submit" class="bg-[#FF6200] text-white px-8 py-2 rounded btn">Crear</button>
                <button type="button" onclick="cerrarModal()" class="bg-[#FF0000] text-white px-8 py-2 rounded btn">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Venta -->
<div id="modalEditar" class="fixed inset-0 flex items-center justify-center z-30 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-center">Editar Venta</h2>
        <form id="editarVentaForm" class="space-y-3" method="POST" action="{{ route('ventas.editar') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_factura" id="id_factura">
            <input type="text" name="nombre_cliente" id="editar_nombre_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Nombre del Cliente" required>
            <input type="text" name="telefono_cliente" id="editar_telefono_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Teléfono" required>
            <input type="email" name="correo_cliente" id="editar_correo_cliente" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Correo" required>
            <input type="text" name="producto" id="editar_producto" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Producto" required>
            <input type="number" name="total" id="editar_total" class="w-full bg-[#D9D9D9] px-4 py-2 rounded" placeholder="Total" required>
            <div class="flex justify-center gap-6 pt-4">
                <button type="submit" class="bg-[#FF6200] text-white px-8 py-2 rounded btn">Guardar Cambios</button>
                <button type="button" onclick="cerrarModalEditar()" class="bg-[#FF0000] text-white px-8 py-2 rounded btn">Cancelar</button>
            </div>
        </form>
    </div>
</div>