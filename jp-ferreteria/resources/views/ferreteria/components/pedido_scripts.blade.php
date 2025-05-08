<!-- Intro.js -->
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>
    // Sidebar toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');
        sidebar.classList.toggle('-translate-x-full');
        content.classList.toggle('ml-56');
    }

    function abrirModal() {
        document.getElementById('modalVenta').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalVenta').classList.add('hidden');
    }

    function abrirModalEditar(venta) {
        document.getElementById('id_factura').value = venta.ID_FACTURA;
        document.getElementById('editar_nombre_cliente').value = venta.cliente.NOMBRE_CLIENTE;
        document.getElementById('editar_telefono_cliente').value = venta.cliente.TELEFONO_CLIENTE;
        document.getElementById('editar_correo_cliente').value = venta.cliente.CORREO_CLIENTE;
        document.getElementById('editar_producto').value = venta.productos.map(p => p.NOMBRE_PRODUCTO).join(', ');
        document.getElementById('editar_total').value = venta.TOTAL;

        document.getElementById('modalEditar').classList.remove('hidden');
    }

    function cerrarModalEditar() {
        document.getElementById('modalEditar').classList.add('hidden');
    }

    function iniciarTutorial() {
        introJs().setOptions({
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            skipLabel: 'Saltar',
            doneLabel: 'Finalizar',
            showProgress: false, // Desactiva la barra de progreso
            showBullets: true, // Mantiene los puntos de progreso visibles
            tooltipClass: 'custom-introjs-tooltip pedidos', // Clase específica para pedidos
            highlightClass: 'custom-highlight', // Clase personalizada para resaltar elementos
            scrollToElement: true, // Asegura que el elemento esté visible en la pantalla
            positionPrecedence: ['bottom', 'top', 'right', 'left'] // Ajusta la posición del cuadro
        }).start();
    }

    // Ya no se ejecuta automáticamente

    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('#search-input');
        const searchButton = document.querySelector('#search-button');
        const tableRows = document.querySelectorAll('tbody tr');

        searchButton.addEventListener('click', () => {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const clienteNombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const facturaId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

                if (clienteNombre.includes(searchTerm) || facturaId.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        searchInput.addEventListener('input', () => {
            if (searchInput.value === '') {
                tableRows.forEach(row => {
                    row.style.display = '';
                });
            }
        });
    });
</script>