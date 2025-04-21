<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');
    const topbar = document.getElementById('topbar');
    const bottombar = document.getElementById('bottombar');
    const btnEntregar = document.getElementById('btn-entregar');
    const btnAyuda = document.getElementById('btn-ayuda');

    const applyOverlay = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        topbar?.classList.add('opacity-40');
        bottombar?.classList.add('opacity-40');
    };

    const removeOverlay = () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        topbar?.classList.remove('opacity-40');
        bottombar?.classList.remove('opacity-40');
    };

    const handleEntrega = () => {
        const confirmado = confirm('¿Estás seguro de que deseas marcar esta orden como entregada?');
        if (confirmado) {
            console.log('Orden marcada como entregada');
            // Lógica adicional aquí
        } else {
            console.log('Entrega cancelada');
        }
    };

    // Listeners de sidebar
    if (toggleBtn && closeBtn && sidebar && overlay) {
        toggleBtn.addEventListener('click', applyOverlay);
        closeBtn.addEventListener('click', removeOverlay);
        overlay.addEventListener('click', removeOverlay);
    }

    // Listener de botón de entrega
    if (btnEntregar) {
        btnEntregar.addEventListener('click', handleEntrega);
    }

    // Listener de ayuda interactiva
    if (btnAyuda) {
        btnAyuda.addEventListener('click', () => {
            introJs().start();
        });
    }
</script>
