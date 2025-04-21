<!-- Botón para abrir el sidebar -->
<button
    id="toggleSidebar"
    class="toggleSidebar"
    data-step="2"
    data-intro="Este botón abre el menú lateral, donde puedes navegar a la vista del historial o volver a la vista de las órdenes."
    data-title="Menú lateral"
    aria-label="Abrir menú lateral"
>
    ☰
</button>

<!-- Sidebar -->
<div id="sidebar" class="transform -translate-x-full transition-transform">
    <!-- Botón para cerrar el sidebar -->
    <button id="closeSidebar" aria-label="Cerrar menú lateral">
        ✖
    </button>

    <ul class="space-y-4 mt-4">
        <li>
            <a href="{{ route('historical.index') }}" class="sidebar-link">
                Histórico
            </a>
        </li>
        <li>
            <a href="{{ route('delivery.index') }}" class="sidebar-link">
                Órdenes
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button
                    type="submit"
                    class="sidebar-link-logout"
                >
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </li>
    </ul>
</div>
