<!-- Barra lateral izquierda (Sidebar) -->
<div id="sidebar" class="bg-gray-300 w-56 min-h-screen p-4 space-y-4 fixed transform -translate-x-full transition-transform duration-300 ease-in-out z-20">

    <!-- Botón sección ventas -->
    <a href="{{ route('cashier') }}" data-intro="ventas" class="block w-full bg-[#83A5CE] text-white py-3 rounded text-lg text-center hover:bg-[#6B8BBF] transition-colors">
        Dashboard
    </a>

    <!-- Botón sección catálogo -->
    <a href="{{ route('cashiermanager') }}" data-intro="catalogo" class="block w-full bg-[#83A5CE] text-white py-3 rounded text-lg text-center hover:bg-[#6B8BBF] transition-colors">
        Ventas
    </a>

    <!-- Botón cerrar sesión -->
    <div class="absolute bottom-4 left-4 right-4">
        <a href="{{ route('logout') }}" data-intro="cerrar-sesion" class="block w-full bg-[#83A5CE] text-white py-3 rounded text-lg text-center hover:bg-[#6B8BBF] transition-colors">
            Cerrar Sesión
        </a>
    </div>
</div>