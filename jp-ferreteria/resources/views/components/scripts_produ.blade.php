<script>
    const modal = document.getElementById('formularioModal');

    function mostrarFormulario() {
        modal.classList.remove('hidden');
    }

    function ocultarFormulario() {
        modal.classList.add('hidden');
    }

    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        sidebar.classList.toggle('closed');
        mainContent.classList.toggle('expanded');

        // Mover el botón según el estado del sidebar
        if (sidebar.classList.contains('closed')) {
            toggleBtn.style.left = '20px';
        } else {
            toggleBtn.style.left = '270px';
        }
    });

    window.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (sidebar.classList.contains('closed')) {
            toggleBtn.style.left = '20px';
        } else {
            toggleBtn.style.left = '270px';
        }
    });
</script>
