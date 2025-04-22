<!-- Intro.js -->
<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>

<script>
    // Función para alternar el sidebar (manual o al hacer clic)
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');
        sidebar.classList.toggle('-translate-x-full');
        content.classList.toggle('ml-56');
    }

    // Función para abrir el sidebar si está cerrado
    function abrirSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            content.classList.add('ml-56');
        }
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
        const tutorial = introJs();

        tutorial.setOptions({
            steps: [
                {
                    element: document.querySelector('[data-intro="crear-venta"]'),
                    intro: "Inicia una nueva transacción desde aquí. ¡Es el primer paso para registrar una venta!"
                },
                {
                    element: document.querySelector('[data-intro="buscar"]'),
                    intro: "¿Buscas una venta anterior? Usa esta herramienta para encontrarla por nombre o ID."
                },
                {
                    element: document.querySelector('[data-intro="editar"]'),
                    intro: "¿Cometiste un error o necesitas actualizar información? Aquí puedes editar ventas existentes."
                },
                {
                    element: document.querySelector('[data-intro="deshabilitar"]'),
                    intro: "Este botón te permite deshabilitar ventas que ya no deben estar activas. ¡Sin eliminarlas!"
                },
                {
                    element: document.querySelector('[data-intro="ventas"]'),
                    intro: "Accede a todo el historial de ventas. Consulta, analiza o revisa cada detalle desde aquí."
                },
                {
                    element: document.querySelector('[data-intro="catalogo"]'),
                    intro: "Aquí puedes explorar productos disponibles para la venta."
                },
                {
                    element: document.querySelector('[data-intro="cerrar-sesion"]'),
                    intro: "Finaliza tu sesión de forma segura. ¡Hasta pronto!"
                }
            ],
            nextLabel: 'Siguiente',
            prevLabel: 'Anterior',
            doneLabel: 'Finalizar'
        });

        tutorial.onbeforechange(async function(element) {
    const elementosEnSidebar = ['ventas', 'catalogo', 'cerrar-sesion'];
    if (element && element.getAttribute('data-intro')) {
        const actual = element.getAttribute('data-intro');
        if (elementosEnSidebar.includes(actual)) {
            abrirSidebar();

            // Esperar 300ms para que el sidebar se termine de mostrar
            await new Promise(resolve => setTimeout(resolve, 300));

            // Reforzar que intro.js recalibre la posición del tooltip
            tutorial.refresh();
        }
    }
});

tutorial.start();
    }

    // No se inicia automáticamente
</script>
