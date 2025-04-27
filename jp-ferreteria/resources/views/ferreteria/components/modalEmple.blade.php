<!-- Modal para crear empleado -->
<div id="formularioModal" class="modal hidden">
    <div class="modal-content">
        <h2>Crear Empleado</h2>
        <form>
            <input type="text" placeholder="Primer Nombre" required>
            <input type="text" placeholder="Segundo Nombre">
            <input type="text" placeholder="Primer Apellido" required>
            <input type="text" placeholder="Segundo Apellido">
            <input type="email" placeholder="Correo" required>
            <input type="text" placeholder="Rol" required>
            <input type="text" placeholder="Estado" required>
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>