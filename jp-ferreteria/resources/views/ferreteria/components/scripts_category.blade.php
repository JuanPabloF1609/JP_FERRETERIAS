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

        // Función para abrir el modal de editar categoría
        function abrirModalEditar(categoriaId) {
            const editarForm = document.getElementById('editarForm');
            const editarNombreCategoria = document.getElementById('editar-nombre-categoria');
            const editarDescripcion = document.getElementById('editar-descripcion');
            const editarModal = document.getElementById('editarModal');

            // Realizar una solicitud AJAX para obtener los datos de la categoría
            fetch(`/categories/${categoriaId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los datos de la categoría');
                    }
                    return response.json();
                })
                .then(data => {
                    // Llenar los campos del formulario con los datos de la categoría
                    editarNombreCategoria.value = data.NOMBRE_CATEGORIA;
                    editarDescripcion.value = data.DESCRIPCION;

                    // Actualizar la acción del formulario con la URL correcta
                    editarForm.action = `/categories/${categoriaId}`;
                })
                .catch(error => console.error('Error al obtener los datos de la categoría:', error));

            // Mostrar el modal de edición
            editarModal.classList.remove('hidden');
        }

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
                    // Verifica si el botón con el atributo data-id existe
                    const button = document.querySelector(`button[data-id="${data.id}"]`);
                    if (button) {
                        const row = button.closest('tr');
                        row.querySelector('td:nth-child(2)').textContent = data.NOMBRE_CATEGORIA;
                        row.querySelector('td:nth-child(3)').textContent = data.DESCRIPCION;
                    }

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
        window.abrirModalEditar = abrirModalEditar; // Añadido para que sea accesible globalmente
    });
</script>