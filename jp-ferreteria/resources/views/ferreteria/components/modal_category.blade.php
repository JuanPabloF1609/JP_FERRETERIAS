<!-- Modal -->
<div id="formularioModal" class="modal hidden">
    <div class="modal-content">
        <h2>Crear Categoría</h2>
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            <label for="nombre-categoria">Nombre Categoría</label>
            <input id="nombre-categoria" name="NOMBRE_CATEGORIA" type="text" required>
            
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="DESCRIPCION" style="border: 1px solid black; background-color: #f0f0f0; width: 100%; height: 100px;"></textarea>
            
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal para editar -->
<div id="editarModal" class="modal hidden">
    <div class="modal-content">
        <h2>Editar Categoría</h2>
        <form id="editarForm" method="POST" action="">
            @csrf
            @method('PATCH') <!-- Cambiado a PATCH -->
            <label for="editar-nombre-categoria">Nombre Categoría</label>
            <input id="editar-nombre-categoria" name="NOMBRE_CATEGORIA" type="text" required>
            
            <label for="editar-descripcion">Descripción</label>
            <textarea id="editar-descripcion" name="DESCRIPCION" style="border: 1px solid black; background-color: #f0f0f0; width: 100%; height: 100px;"></textarea>
            
            <div class="modal-actions">
                <button type="submit" class="btn-editar" style="background-color: blue; color: white; border: 1px solid blue; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    Guardar Cambios
                </button>
                <button type="button" onclick="ocultarEditarModal()" class="btn-cancelar" style="padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>