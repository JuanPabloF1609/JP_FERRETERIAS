<!-- MODAL CREAR PRODUCTO -->
<div id="formularioModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content max-w-2xl w-full mx-2 bg-white rounded-lg shadow-lg p-6 overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-bold mb-4">Crear Producto</h2>
        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input id="NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" type="text" placeholder="Nombre del Producto" class="border rounded p-2" required>
                <input id="PRECIO" name="PRECIO" type="number" step="0.01" placeholder="Precio" class="border rounded p-2" required>
                <input id="CANTIDAD" name="CANTIDAD" type="number" placeholder="Cantidad" class="border rounded p-2" required>
                <input id="STOCK_MINIMO" name="STOCK_MINIMO" type="number" placeholder="Stock Mínimo" class="border rounded p-2">
                <select id="ID_CATEGORIA" name="ID_CATEGORIA" class="border rounded p-2">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->ID_CATEGORIA }}">{{ $categoria->NOMBRE_CATEGORIA }}</option>
                    @endforeach
                </select>
                <input id="REFERENCIA" name="REFERENCIA" type="text" placeholder="Referencia" class="border rounded p-2">
            </div>
            <textarea id="DESCRIPCION" name="DESCRIPCION" placeholder="Descripción del producto" class="border rounded p-2 w-full"></textarea>
            <input id="fotos" name="fotos[]" type="file" accept="image/*" class="border rounded p-2 w-full" multiple >

            <hr class="my-2">

            <h3 class="font-semibold text-gray-700 mb-2">Detalles adicionales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input id="MARCA" name="MARCA" type="text" placeholder="Marca" class="border rounded p-2">
                <input id="COLOR" name="COLOR" type="text" placeholder="Color" class="border rounded p-2">
                <input id="UNIDAD_MEDIDA" name="UNIDAD_MEDIDA" type="text" placeholder="Unidad de Medida" class="border rounded p-2">
                <input id="MATERIAL" name="MATERIAL" type="text" placeholder="Material" class="border rounded p-2">
                <input id="DIMENSIONES" name="DIMENSIONES" type="text" placeholder="Dimensiones" class="border rounded p-2">
                <input id="USO" name="USO" type="text" placeholder="Uso" class="border rounded p-2">
                <input id="NORMA" name="NORMA" type="text" placeholder="Norma" class="border rounded p-2">
                <input id="PROCEDENCIA" name="PROCEDENCIA" type="text" placeholder="Procedencia" class="border rounded p-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="OFERTA" name="OFERTA" value="1" class="h-4 w-4">
                    <label for="OFERTA" class="text-sm">Oferta del día</label>
                </div>
                <input id="PRECIO_OFERTA" name="PRECIO_OFERTA" type="number" step="0.01" placeholder="Precio Oferta" class="border rounded p-2">
                <input id="CUOTAS" name="CUOTAS" type="number" placeholder="Cuotas" class="border rounded p-2">
                <input id="CUOTA_VALOR" name="CUOTA_VALOR" type="number" step="0.01" placeholder="Valor por Cuota" class="border rounded p-2">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="MAS_VENDIDO" name="MAS_VENDIDO" value="1" class="h-4 w-4">
                    <label for="MAS_VENDIDO" class="text-sm">Más vendido</label>
                </div>
            </div>
            <textarea id="CARACTERISTICAS" name="CARACTERISTICAS" placeholder="Características principales" class="border rounded p-2 w-full"></textarea>

            <div class="modal-actions flex justify-end gap-2 mt-4">
                <button type="submit" class="btn-crear bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDITAR PRODUCTO -->
<div id="modalEditarProducto" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="modal-content max-w-2xl w-full mx-2 bg-white rounded-lg shadow-lg p-6 overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-bold mb-4">Editar Producto</h2>
        <form id="formEditarProducto" method="POST" action="" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input id="edit_NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" type="text" placeholder="Nombre del Producto" class="border rounded p-2" required>
                <input id="edit_PRECIO" name="PRECIO" type="number" step="0.01" placeholder="Precio" class="border rounded p-2" required>
                <input id="edit_CANTIDAD" name="CANTIDAD" type="number" placeholder="Cantidad" class="border rounded p-2" required>
                <input id="edit_STOCK_MINIMO" name="STOCK_MINIMO" type="number" placeholder="Stock Mínimo" class="border rounded p-2">
                <select id="edit_ID_CATEGORIA" name="ID_CATEGORIA" class="border rounded p-2">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->ID_CATEGORIA }}">{{ $categoria->NOMBRE_CATEGORIA }}</option>
                    @endforeach
                </select>
                <input id="edit_REFERENCIA" name="REFERENCIA" type="text" placeholder="Referencia" class="border rounded p-2">
            </div>
            <textarea id="edit_DESCRIPCION" name="DESCRIPCION" placeholder="Descripción del producto" class="border rounded p-2 w-full"></textarea>
            <input id="edit_fotos" name="fotos[]" type="file" accept="image/*" class="border rounded p-2 w-full" multiple >

            <hr class="my-2">

            <h3 class="font-semibold text-gray-700 mb-2">Detalles adicionales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input id="edit_MARCA" name="MARCA" type="text" placeholder="Marca" class="border rounded p-2">
                <input id="edit_COLOR" name="COLOR" type="text" placeholder="Color" class="border rounded p-2">
                <input id="edit_UNIDAD_MEDIDA" name="UNIDAD_MEDIDA" type="text" placeholder="Unidad de Medida" class="border rounded p-2">
                <input id="edit_MATERIAL" name="MATERIAL" type="text" placeholder="Material" class="border rounded p-2">
                <input id="edit_DIMENSIONES" name="DIMENSIONES" type="text" placeholder="Dimensiones" class="border rounded p-2">
                <input id="edit_USO" name="USO" type="text" placeholder="Uso" class="border rounded p-2">
                <input id="edit_NORMA" name="NORMA" type="text" placeholder="Norma" class="border rounded p-2">
                <input id="edit_PROCEDENCIA" name="PROCEDENCIA" type="text" placeholder="Procedencia" class="border rounded p-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="edit_OFERTA" name="OFERTA" value="1" class="h-4 w-4">
                    <label for="edit_OFERTA" class="text-sm">Oferta del día</label>
                </div>
                <input id="edit_PRECIO_OFERTA" name="PRECIO_OFERTA" type="number" step="0.01" placeholder="Precio Oferta" class="border rounded p-2">
                <input id="edit_CUOTAS" name="CUOTAS" type="number" placeholder="Cuotas" class="border rounded p-2">
                <input id="edit_CUOTA_VALOR" name="CUOTA_VALOR" type="number" step="0.01" placeholder="Valor por Cuota" class="border rounded p-2">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="edit_MAS_VENDIDO" name="MAS_VENDIDO" value="1" class="h-4 w-4">
                    <label for="edit_MAS_VENDIDO" class="text-sm">Más vendido</label>
                </div>
            </div>
            <textarea id="edit_CARACTERISTICAS" name="CARACTERISTICAS" placeholder="Características principales" class="border rounded p-2 w-full"></textarea>

            <div class="modal-actions flex justify-end gap-2 mt-4">
                <button type="submit" class="btn-crear bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar Cambios</button>
                <button type="button" onclick="cerrarModalEditar()" class="btn-cancelar bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
            </div>
        </form>
    </div>
</div>