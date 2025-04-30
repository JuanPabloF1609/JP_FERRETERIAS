 <!-- Modal -->
 <div id="formularioModal" class="modal hidden">
    <div class="modal-content">
        <h2>Crear Producto</h2>
        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @csrf
            <input id="NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" type="text" placeholder="Nombre del Producto" class="w-full border rounded p-2" required>
            <input id="PRECIO" name="PRECIO" type="number" step="0.01" placeholder="Precio" class="w-full border rounded p-2" required>
            <input id="CANTIDAD" name="CANTIDAD" type="number" placeholder="Cantidad" class="w-full border rounded p-2" required>
            <input id="STOCK_MINIMO" name="STOCK_MINIMO" type="number" placeholder="Stock Mínimo" class="w-full border rounded p-2">
            <!-- Select para las categorías -->
            <select id="ID_CATEGORIA" name="ID_CATEGORIA" class="w-full border rounded mb-4 p-2">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->ID_CATEGORIA }}">{{ $categoria->NOMBRE_CATEGORIA }}</option>
                @endforeach
            </select>
            <input id="REFERENCIA" name="REFERENCIA" type="text" placeholder="Referencia" class="w-full border rounded p-2">
            <textarea id="DESCRIPCION" name="DESCRIPCION" placeholder="Descripción del producto" class="w-full border rounded p-2"></textarea>
            <input id="fotos" name="fotos[]" type="file" accept="image/*" class="w-full border rounded p-2" multiple >
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>


<div id="modalEditarProducto" class="modal hidden">
    <div class="modal-content">
        <h2>Editar Producto</h2>
        <form id="formEditarProducto" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input id="edit_NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" type="text" placeholder="Nombre del Producto" class="w-full border rounded p-2" required>
            <input id="edit_PRECIO" name="PRECIO" type="number" step="0.01" placeholder="Precio" class="w-full border rounded p-2" required>
            <input id="edit_CANTIDAD" name="CANTIDAD" type="number" placeholder="Cantidad" class="w-full border rounded p-2" required>
            <input id="edit_STOCK_MINIMO" name="STOCK_MINIMO" type="number" placeholder="Stock Mínimo" class="w-full border rounded p-2">
            <!-- Select para las categorías -->
            <select id="edit_ID_CATEGORIA" name="ID_CATEGORIA" class="w-full border rounded mb-4 p-2">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->ID_CATEGORIA }}">{{ $categoria->NOMBRE_CATEGORIA }}</option>
                @endforeach
            </select>
            <input id="edit_REFERENCIA" name="REFERENCIA" type="text" placeholder="Referencia" class="w-full border rounded p-2">
            <textarea id="edit_DESCRIPCION" name="DESCRIPCION" placeholder="Descripción del producto" class="w-full border rounded p-2"></textarea>
            <input id="edit_fotos" name="fotos[]" type="file" accept="image/*" class="w-full border rounded p-2" multiple>
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Guardar Cambios</button>
                <button type="button" onclick="cerrarModalEditar()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>