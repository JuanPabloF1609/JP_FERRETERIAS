<!-- Botón para abrir el sidebar -->
<button id="toggleSidebar" class="toggleSidebar"data-step="2"
    data-intro="Este botón abre el menú lateral, donde puedes navegar a la vista del historial o volver a la vista de las ordendes."
    data-title="Menú lateral">
    ☰
</button>

<!-- Sidebar -->
<div id="sidebar" class="transform -translate-x-full transition-transform">
    <button id="closeSidebar">✖</button>
    <ul class="space-y-4">
        <li><a href="{{ route('historical.index') }}" class="sidebar-link">Histórico</a></li>
        <li><a href="{{ route('delivery.index') }}" class="sidebar-link">Órdenes</a></li>
        <li><a href="#" class="sidebar-link sidebar-link-logout">Cerrar Sesión</a></li>
    </ul>
</div>
