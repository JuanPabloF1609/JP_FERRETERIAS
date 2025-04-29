<!-- Scripts -->
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const formularioModal = document.getElementById('formularioModal');
        const editarModal = document.getElementById('editarModal');
        const editarForm = document.getElementById('editarForm');
        const editarNombreCategoria = document.getElementById('editar-nombre-categoria');
        const editarDescripcion = document.getElementById('editar-descripcion');
        const searchBtn = document.querySelector('.btn-buscar');
        const searchInput = document.querySelector('.search-section input');
        const productosContainer = document.getElementById('productos-container');
        const sinResultados = document.getElementById('sin-resultados');

        // Función para mostrar el modal de crear categoría
        function mostrarFormulario() {
            formularioModal.classList.remove('hidden');
        }

        // Función para ocultar el modal de crear categoría
        function ocultarFormulario() {
            formularioModal.classList.add('hidden');
        }

        // Delegar el evento click en los botones "Editar"
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-editar')) {
                const id = event.target.getAttribute('data-id');
                const nombre = event.target.getAttribute('data-nombre');
                const descripcion = event.target.getAttribute('data-descripcion');

                // Configurar el formulario con los datos de la categoría
                editarForm.action = `/categories/${id}`;
                editarNombreCategoria.value = nombre;
                editarDescripcion.value = descripcion;

                // Mostrar el modal de edición
                editarModal.classList.remove('hidden');
            }
        });

        // Función para ocultar el modal de editar categoría
        function ocultarEditarModal() {
            editarModal.classList.add('hidden');
        }

        // Actualizar la tabla después de guardar cambios
        editarForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar el envío normal del formulario

            const formData = new FormData(editarForm);
            const actionUrl = editarForm.action;

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Actualizar la fila correspondiente en la tabla
                    const row = document.querySelector(`button[data-id="${data.id}"]`).closest('tr');
                    row.querySelector('td:nth-child(2)').textContent = data.NOMBRE_CATEGORIA;
                    row.querySelector('td:nth-child(3)').textContent = data.DESCRIPCION;

                    // Ocultar el modal
                    ocultarEditarModal();
                } else {
                    alert('Error al guardar los cambios.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al guardar los cambios.');
            });
        });

        // Función para buscar registros por ID o nombre
        function buscarRegistros() {
            const term = searchInput.value.trim().toLowerCase();
            const rows = productosContainer.querySelectorAll('tr');
            let hasResults = false;

            rows.forEach(row => {
                const id = row.querySelector('td:nth-child(1)')?.textContent.trim().toLowerCase();
                const nombre = row.querySelector('td:nth-child(2)')?.textContent.trim().toLowerCase();

                if (id?.includes(term) || nombre?.includes(term)) {
                    row.style.display = ''; // Mostrar la fila
                    hasResults = true;
                } else {
                    row.style.display = 'none'; // Ocultar la fila
                }
            });

            // Mostrar mensaje de "sin resultados" si no hay coincidencias
            if (!hasResults && term !== '') {
                sinResultados.style.display = '';
            } else {
                sinResultados.style.display = 'none';
            }

            // Si el campo de búsqueda está vacío, mostrar todas las filas
            if (term === '') {
                rows.forEach(row => {
                    row.style.display = ''; // Mostrar todas las filas
                });
                sinResultados.style.display = 'none'; // Ocultar mensaje de "sin resultados"
            }
        }

        // Evento para buscar al presionar el botón "Buscar"
        searchBtn.addEventListener('click', buscarRegistros);

        // Evento para buscar automáticamente al cambiar el texto del campo de búsqueda
        searchInput.addEventListener('input', function () {
            if (searchInput.value.trim() === '') {
                buscarRegistros(); // Mostrar todas las filas automáticamente
            }
        });

        // Hacer las funciones accesibles globalmente
        window.mostrarFormulario = mostrarFormulario;
        window.ocultarFormulario = ocultarFormulario;
        window.ocultarEditarModal = ocultarEditarModal;
    });
</script>