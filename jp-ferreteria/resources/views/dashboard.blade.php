<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])x  
</head>
<body class="bg-gray-100 font-sans flex"> <!-- Añadido flex -->

    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg fixed h-full border-r border-gray-200">
        <!-- Logo/Header -->
        <div class="p-4 border-b border-gray-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h2 class="text-xl font-semibold ml-2">Inventario</h2>
        </div>
        
        <!-- Menú -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-orange-50 group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-orange-50 group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="ml-3">Productos</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-orange-50 group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="ml-3">Empleado </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-orange-50 group">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="ml-3">Configuraciones</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Contenido principal (con margen para el sidebar) -->
    <div class="flex-1 ml-64"> <!-- Añadido ml-64 -->
        <div class="p-8 max-w-7xl mx-auto">
            <!-- Mantengo tu dashboard existente -->
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Gestión de productos</h1>
            
            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center justify-center border">
                    <div class="bg-orange-500 rounded-full p-2 mb-2">
                        <img src="/icons/inventario.svg" class="w-6 h-6" alt="Inventario">
                    </div>
                    <p class="font-semibold text-center">Productos en inventario:</p>
                    <p class="text-2xl font-bold">{{ $estadisticas['inventario'] ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center justify-center border">
                    <div class="bg-orange-500 rounded-full p-2 mb-2">
                        <img src="/icons/bajo-stock.svg" class="w-6 h-6" alt="Bajo Stock">
                    </div>
                    <p class="font-semibold text-center">Bajo Stock:</p>
                    <p class="text-2xl font-bold">{{ $estadisticas['bajo_stock'] ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center justify-center border">
                    <div class="bg-orange-500 rounded-full p-2 mb-2">
                        <img src="/icons/inactivos.svg" class="w-6 h-6" alt="Inactivos">
                    </div>
                    <p class="font-semibold text-center">Productos inactivos:</p>
                    <p class="text-2xl font-bold">{{ $estadisticas['inactivos'] ?? 0 }}</p>
                </div>
            </div>

            <!-- Resto de tu contenido original -->
            <!-- Buscador -->
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-6">
                <input type="text" class="w-full sm:w-2/3 px-4 py-2 rounded bg-gray-200 focus:outline-none" placeholder="Buscar producto por nombre o ID">
                <button type="button" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 search-btn">Buscar</button>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-300 text-gray-800 font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center">ID</th>
                            <th class="px-4 py-3 text-center">NOMBRE</th>
                            <th class="px-4 py-3 text-center">CATEGORÍA</th>
                            <th class="px-4 py-3 text-center">ESTADO</th>
                            <th class="px-4 py-3 text-center">CANTIDAD</th>
                            <th class="px-4 py-3 text-center">PRECIO</th>
                            <th class="px-4 py-3 text-center">
                                <button onclick="mostrarFormulario()" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                                    Crear producto
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="productos-container" class="bg-white text-center text-sm">
                        <tr id="sin-resultados" style="display: none;">
                            <td colspan="7" class="py-4 text-gray-500">
                                Ingrese un término de búsqueda para mostrar productos
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL (manteniendo tu código original) -->
    <div id="formularioModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center hidden z-50">
        <div class="bg-white p-8 rounded-lg w-96">
            <h2 class="text-xl font-semibold mb-6 text-center">Crear Producto</h2>
            <form>
                <input type="text" placeholder="SKU o ID del producto" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="text" placeholder="Nombre del Producto" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="text" placeholder="Categoría" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="number" placeholder="Cantidad" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="text" placeholder="Precio" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="text" placeholder="Presentación" class="w-full px-4 py-2 mb-3 bg-gray-200 rounded focus:outline-none">
                <input type="text" placeholder="Estado" class="w-full px-4 py-2 mb-6 bg-gray-200 rounded focus:outline-none">
                <div class="flex justify-between">
                    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Crear</button>
                    <button type="button" onclick="ocultarFormulario()" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts (manteniendo tu código original) -->
    <script>
        const modal = document.getElementById('formularioModal');
        function mostrarFormulario() {
            modal.classList.remove('hidden');
        }
        function ocultarFormulario() {
            modal.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchBtn = document.querySelector('.search-btn');
            const searchInput = document.querySelector('input[type="text"]');
            const productosContainer = document.getElementById('productos-container');
            const sinResultados = document.getElementById('sin-resultados');

            sinResultados.style.display = 'none';

            searchBtn.addEventListener('click', function () {
                const term = searchInput.value.trim();

                if (term === '') {
                    sinResultados.textContent = 'Ingrese un término de búsqueda para mostrar productos';
                    sinResultados.style.display = '';
                    productosContainer.innerHTML = '';
                    productosContainer.appendChild(sinResultados);
                    return;
                }
            });
        });
    </script>
</body>
</html>