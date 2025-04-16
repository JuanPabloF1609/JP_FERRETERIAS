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

    function abrirModalEditar() {
        document.getElementById('modalEditar').classList.remove('hidden');
    }

    function cerrarModalEditar() {
        document.getElementById('modalEditar').classList.add('hidden');
    }

    function iniciarTutorial() {
        introJs().setOptions({
            steps: [
                {
                    element: document.querySelector('[data-intro="crear-venta"]'),
                    intro: "Aquí puedes crear una nueva venta."
                },
                {
                    element: document.querySelector('[data-intro="buscar"]'),
                    intro: "Este botón te permite buscar ventas por nombre o ID."
                },
                {
                    element: document.querySelector('[data-intro="editar"]'),
                    intro: "Usa este botón para editar una venta existente."
                },
                {
                    element: document.querySelector('[data-intro="deshabilitar"]'),
                    intro: "Este botón deshabilita una venta."
                },
                {
                    element: document.querySelector('[data-intro="ventas"]'),
                    intro: "Este botón abre el módulo de ventas."
                },
                {
                    element: document.querySelector('[data-intro="catalogo"]'),
                    intro: "Accede al catálogo desde aquí."
                },
                {
                    element: document.querySelector('[data-intro="cerrar-sesion"]'),
                    intro: "Cierra tu sesión desde este botón."
                }
            ],
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            doneLabel: 'Finalizar'
        }).start();
    }

    // Ya no se ejecuta automáticamente
</script>
