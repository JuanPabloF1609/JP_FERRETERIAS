 <!-- Modal -->
 <div id="formularioModal" class="modal hidden">
    <div class="modal-content">
        <h2>Crear Producto</h2>
        <form>
            <input type="text" placeholder="SKU o ID del producto">
            <input type="text" placeholder="Nombre del Producto">
            <input type="text" placeholder="Categoría">
            <input type="number" placeholder="Cantidad">
            <input type="text" placeholder="Precio">
            <input type="text" placeholder="Presentación">
            <input type="text" placeholder="Estado">
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>