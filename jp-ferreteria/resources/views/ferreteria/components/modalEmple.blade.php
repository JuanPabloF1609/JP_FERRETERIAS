<!-- Modal para crear empleado -->
<div id="formularioModal" class="modal hidden">
    <div class="modal-content">
        <h2>Crear Empleado</h2>
        <form method="POST" action="{{ route('empleados.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            <select name="role" required>
                <option value="">Seleccione sun rol</option>
                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <select name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
            <div class="modal-actions">
                <button type="submit" class="btn-crear">Crear</button>
                <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar empleado -->
<div id="editarModal" class="modal hidden">
    <div class="modal-content">
        <h2>Editar Empleado</h2>
        <form id="editarForm" method="POST" action="">
            @csrf
            @method('PATCH')
            <input id="editar-name" name="name" type="text" required>
            <input id="editar-email" name="email" type="email" required>
            <select id="editar-role" name="role" required>
                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <select id="editar-estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
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