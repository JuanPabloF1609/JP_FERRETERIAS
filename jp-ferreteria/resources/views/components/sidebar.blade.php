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
        <li>
                     <form method="POST" action="{{ route('logout') }}" class="w-full">
                         @csrf
                        <button type="submit" class="w-full text-left flex items-center px-4 py-2 hover:bg-gray-100 transition-colors">
                             <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Cerrar Sesión</span>
                            </button>
                     </form>
                </li>
    </ul>
</div>
