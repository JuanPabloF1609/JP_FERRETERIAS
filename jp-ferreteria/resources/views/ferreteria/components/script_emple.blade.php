<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formularioModal = document.getElementById('formularioModal');
        const editarModal = document.getElementById('editarModal');
        const editarForm = document.getElementById('editarForm');
        const editarName = document.getElementById('editar-name');
        const editarEmail = document.getElementById('editar-email');
        const editarRole = document.getElementById('editar-role');
        const editarEstado = document.getElementById('editar-estado');
        const searchBtn = document.querySelector('.btn-buscar');
        const searchInput = document.querySelector('.search-section input');
        const empleadosContainer = document.querySelector('.table-section tbody');
        const sinResultados = document.getElementById('sin-resultados');

        function mostrarFormulario() {
            formularioModal.classList.remove('hidden');
        }

        function ocultarFormulario() {
            formularioModal.classList.add('hidden');
        }

        function abrirModalEditar(empleadoId) {
            fetch(`/empleados/${empleadoId}`)
                .then(response => response.json())
                .then(data => {
                    editarName.value = data.name;
                    editarEmail.value = data.email;
                    editarRole.value = data.role;
                    editarEstado.value = data.estado;
                    editarForm.action = `/empleados/${empleadoId}`;
                    editarModal.classList.remove('hidden');
                })
                .catch(error => {
                    alert('Error al obtener los datos del empleado');
                    console.error(error);
                });
        }

        function ocultarEditarModal() {
            editarModal.classList.add('hidden');
        }

        editarForm && editarForm.addEventListener('submit', function (event) {
            event.preventDefault();
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
                if (!response.ok) throw new Error('Error en la respuesta del servidor');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresca la tabla para ver los cambios
                } else {
                    alert('Error al guardar los cambios.');
                }
            })
            .catch(error => {
                alert('Ocurrió un error al guardar los cambios.');
                console.error(error);
            });
        });

        function buscarEmpleados() {
            const term = searchInput.value.trim().toLowerCase();
            const rows = empleadosContainer.querySelectorAll('tr');
            let hasResults = false;

            rows.forEach(row => {
                const nombre = row.querySelector('td:nth-child(1)')?.textContent.trim().toLowerCase();
                const id = row.querySelector('td:nth-child(2)')?.textContent.trim().toLowerCase();

                if (nombre?.includes(term) || id?.includes(term)) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (!hasResults && term !== '') {
                sinResultados.style.display = '';
            } else {
                sinResultados.style.display = 'none';
            }

            if (term === '') {
                rows.forEach(row => row.style.display = '');
                sinResultados.style.display = 'none';
            }
        }

        searchBtn && searchBtn.addEventListener('click', buscarEmpleados);
        searchInput && searchInput.addEventListener('input', function () {
            if (searchInput.value.trim() === '') buscarEmpleados();
        });

        window.mostrarFormulario = mostrarFormulario;
        window.ocultarFormulario = ocultarFormulario;
        window.abrirModalEditar = abrirModalEditar;
        window.ocultarEditarModal = ocultarEditarModal;
    });
</script>