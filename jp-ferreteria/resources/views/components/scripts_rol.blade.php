<script>
    function mostrarModal() {
        document.getElementById('formularioModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function ocultarModal() {
        document.getElementById('formularioModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Función de búsqueda
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const name = row.querySelector('td:first-child').textContent.toLowerCase();
            const id = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if(name.includes(searchValue) || id.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>