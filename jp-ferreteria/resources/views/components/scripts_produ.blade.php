 <!-- Scripts -->
 <script>
    const modal = document.getElementById('formularioModal');
    function mostrarFormulario() {
        modal.classList.remove('hidden');
    }
    function ocultarFormulario() {
        modal.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.querySelector('.btn-buscar');
        const searchInput = document.querySelector('input[type="text"]');
        const productosContainer = document.getElementById('productos-container');
        const sinResultados = document.getElementById('sin-resultados');

        sinResultados.style.display = 'none';

        searchBtn.addEventListener('click', function () {
            const term = searchInput.value.trim();

            if (term === '') {
                sinResultados.textContent = 'Ingrese un término de búsqueda para mostrar productos';
                sinResultados.style.display = '';
                productosContainer.innerHTML = '';
                productosContainer.appendChild(sinResultados);
                return;
            }
        });
    });
</script>