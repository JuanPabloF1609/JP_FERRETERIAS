<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');
    const topbar = document.getElementById('topbar');
    const bottombar = document.getElementById('bottombar');
    const btnEntregar = document.getElementById('btn-entregar');
    const btnAyuda = document.getElementById('btn-ayuda');


    if (toggleBtn && closeBtn && sidebar && overlay) {
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

        toggleBtn.addEventListener('click', applyOverlay);
        closeBtn.addEventListener('click', removeOverlay);
        overlay.addEventListener('click', removeOverlay);
    }

    // Confirmación de entrega
    if (btnEntregar) {
        btnEntregar.addEventListener('click', () => {
            const confirmado = confirm('¿Estás seguro de que deseas marcar esta orden como entregada?');
            if (confirmado) {
                console.log('Orden marcada como entregada');
                // Aquí puedes colocar la lógica adicional para actualizar la orden
            } else {
                console.log('Entrega cancelada');
            }
        });
    }

    if (btnAyuda) {
        btnAyuda.addEventListener('click', () => {
            introJs().start();
        });
    }
</script>
