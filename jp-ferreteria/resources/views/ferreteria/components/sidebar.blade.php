<!-- Botón para abrir el sidebar -->
<button id="toggleSidebar" class="toggleSidebar" data-step="2"
    data-intro="Este botón abre el menú lateral, donde puedes navegar a las diferentes vistas según tu rol."
    data-title="Menú lateral">
    ☰
</button>

<!-- Sidebar -->
<div id="sidebar" class="transform -translate-x-full transition-transform">
    <button id="closeSidebar">✖</button>
    <ul class="space-y-4">
        <li>
            <a href="{{ route('dashboard') }}" class="sidebar-link">Inicio</a>
        </li>
        <!-- Ruta para Histórico (visible solo para usuarios con permiso 'view_historical') -->
        @can('view_delivery_dashboard')
        <li><a href="{{ route('historical.index') }}" class="sidebar-link">Histórico</a></li>
        @endcan

        <!-- Ruta para Órdenes (visible solo para usuarios con permiso 'view_orders') -->
        @can('view_delivery_dashboard')
        <li><a href="{{ route('delivery.index') }}" class="sidebar-link">Órdenes</a></li>
        @endcan

        <!-- Ruta para Dashboard Admin (visible solo para usuarios con rol 'administrador') -->
        @can('view_admin_dashboard')
        <li><a href="{{ route('admin.dash') }}" class="sidebar-link">Dashboard Admin</a></li>
        @endcan

        <!-- Ruta para Productos (visible solo para usuarios con permiso 'view_products') -->
        @can('view_admin_dashboard')
        <li><a href="{{ route('admin.product') }}" class="sidebar-link">Productos</a></li>
        @endcan

        <!-- Ruta para Empleados (visible solo para usuarios con permiso 'view_employees') -->
        @can('view_admin_dashboard')
        <li><a href="{{ route('admin.employee') }}" class="sidebar-link">Empleados</a></li>
        @endcan

        <!-- Ruta para Pedidos (visible solo para usuarios con permiso 'view_caja_dashboard') -->
        @can('view_caja_dashboard')
        <li><a href="{{ route('caja.pedidos') }}" class="sidebar-link">Pedidos</a></li>
        @endcan

        @can('view_caja_dashboard')
        <li><a href="{{ route('catalogo.index') }}" class="sidebar-link">Catalogo</a></li>
        @endcan

        <!-- Botón para cerrar sesión -->
        <li>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full text-white left-0 font-bold rounded-lg flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </li>
    </ul>
</div>