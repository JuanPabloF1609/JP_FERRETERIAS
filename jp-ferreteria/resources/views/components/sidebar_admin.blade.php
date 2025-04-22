<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Dashboard</h2>
    </div>
    <nav class="sidebar-nav" id="sidebar-nav">
        <ul>
            <li><a href="/empleados"><i class="fas fa-user"></i><span>Empleados</span></a></li>
            <li><a href="/productos" class="active"><i class="fas fa-box"></i><span>Productos</span></a></li>
            <li><a href="/configuraciones"><i class="fas fa-cog"></i><span>Configuraciones</span></a></li>
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
    </nav>
</aside>
