 {{-- Modal --}}
 <div id="formularioModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
    <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg relative">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Crear Rol</h2>
        <form>
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Rol</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del rol"
                    class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <div class="mb-6">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción del rol"
                    class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
            </div>

            <div class="flex justify-end gap-3">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                    Crear
                </button>
                <button type="button" onclick="ocultarModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>