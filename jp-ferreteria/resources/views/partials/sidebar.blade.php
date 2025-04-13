<!-- Botón para abrir el sidebar -->
<button id="toggleSidebar" class="fixed top-1 left-4 z-50 p-2 bg-gray-300 hover:bg-gray-400 rounded">
    ☰
</button>

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-300 p-4 transform -translate-x-full transition-transform duration-300 z-40">
    <button id="closeSidebar" class="mb-4 text-right w-full">✖</button>
    <ul class="space-y-4">
        <li><a href="{{ route('delivery.historico') }}" class="block px-4 py-2 bg-blue-400 text-white text-center rounded hover:bg-blue-500">Histórico</a></li>
        <li><a href="{{ route('dashboard.delivery') }}" class="block px-4 py-2 bg-blue-400 text-white text-center rounded hover:bg-blue-500">Órdenes</a></li>
        <li class="mt-auto"><a href="#" class="block px-4 py-2 mt-80 bg-blue-400 text-white text-center rounded hover:bg-blue-500">Cerrar Sesión</a></li>
    </ul>
</div>
