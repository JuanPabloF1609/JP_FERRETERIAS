<!-- Botón para abrir el sidebar (ícono hamburguesa con líneas más juntas, cortas y negras) --> 
<button id="toggleSidebar"
    class="fixed top-4 left-4 z-50 text-black text-4xl font-bold" 
    style="width: 30px; height: 30px; display: flex; flex-direction: column; justify-content: space-between; align-items: center;">
    <span class="block w-full h-2 bg-black"></span>
    <span class="block w-full h-2 bg-black"></span>
    <span class="block w-full h-2 bg-black"></span>
</button>

<!-- Sidebar sin líneas grises, ocupa toda la altura -->
<div id="sidebar"
    class="bg-gray-300 w-56 h-screen p-4 fixed top-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-60 flex flex-col justify-between">

    <!-- Parte superior -->
    <div class="space-y-4">
        
        <button id="closeSidebar"
            class="text-black text-xl py-3 px-4 rounded text-lg transition ml-auto -mt-8">
            ✖
        </button>


        <!-- Menú -->
        <ul class="space-y-4 mt-4">
            <li>
                <a href="{{ route('historical.index') }}"
                    class="block w-full text-center bg-[#83A5CE] text-white py-3 rounded text-lg hover:bg-[#6B8BBF] transition">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('delivery.index') }}"
                    class="block w-full text-center bg-[#83A5CE] text-white py-3 rounded text-lg hover:bg-[#6B8BBF] transition">
                    Ventas
                </a>
            </li>
        </ul>
    </div>

    <!-- Botón cerrar sesión con POST correcto -->
    <div class="absolute bottom-4 left-4 right-4">
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
            data-intro="cerrar-sesion"
            class="block w-full bg-[#83A5CE] text-white py-3 rounded text-lg text-center hover:bg-[#6B8BBF] transition-colors">
                Cerrar Sesión
            </a>
        </form>
    </div>
</div>


