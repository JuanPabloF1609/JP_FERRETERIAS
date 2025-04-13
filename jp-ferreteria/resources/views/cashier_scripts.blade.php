<!--Contiene el bloque <script>-->
<script>
    // Alterna la visibilidad del sidebar y ajusta el contenido principal
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');
        sidebar.classList.toggle('-translate-x-full');
        content.classList.toggle('ml-56');
    }

    // Muestra el modal de creación de venta
    function abrirModal() {
        document.getElementById('modalVenta').classList.remove('hidden');
    }

    // Oculta el modal de creación de venta
    function cerrarModal() {
        document.getElementById('modalVenta').classList.add('hidden');
    }

    // Muestra el modal de edición de venta
    function abrirModalEditar() {
        document.getElementById('modalEditar').classList.remove('hidden');
    }

    // Oculta el modal de edición de venta
    function cerrarModalEditar() {
        document.getElementById('modalEditar').classList.add('hidden');
    }

    // Simula la navegación al módulo de ventas
    function irAVentas() {
        console.log("Botón Ventas presionado");
        alert("Botón Ventas presionado");
    }

    // Simula la navegación al catálogo
    function irACatalogo() {
        console.log("Botón Catálogo presionado");
        alert("Botón Catálogo presionado");
    }

    // Simula el cierre de sesión del usuario
    function cerrarSesion() {
        console.log("Botón Cerrar Sesión presionado");
        alert("Botón Cerrar Sesión presionado");
    }

    // Simula la búsqueda de una venta
    function buscarVenta() {
        console.log("Botón Buscar presionado");
        alert("Botón Buscar presionado");
    }

    // Simula la desactivación de una venta
    function deshabilitarVenta() {
        console.log("Botón Deshabilitar presionado");
        alert("Botón Deshabilitar presionado");
    }
</script>
