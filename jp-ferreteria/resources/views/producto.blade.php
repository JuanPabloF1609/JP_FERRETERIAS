<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body class="font-sans flex">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="/empleados">
                        <i class="fas fa-user"></i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li>
                    <a href="/productos" class="active">
                        <i class="fas fa-box"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="/configuraciones">
                        <i class="fas fa-cog"></i>
                        <span>Configuraciones</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <h1>Gestión de productos</h1>
            
            <!-- Estadísticas -->
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-box icon"></i>
                    <p class="label">Productos en inventario:</p>
                    <p class="value">{{ $estadisticas['inventario'] ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-exclamation-triangle icon"></i>
                    <p class="label">Bajo Stock:</p>
                    <p class="value">{{ $estadisticas['bajo_stock'] ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-ban icon"></i>
                    <p class="label">Productos inactivos:</p>
                    <p class="value">{{ $estadisticas['inactivos'] ?? 0 }}</p>
                </div>
            </div>

            <!-- Buscador -->
            <div class="search-section">
                <input type="text" placeholder="Buscar producto por nombre o ID">
                <button type="button" class="btn-buscar">Buscar</button>
            </div>

            <!-- Tabla -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CATEGORÍA</th>
                            <th>ESTADO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>
                                <button onclick="mostrarFormulario()" class="btn-crear">
                                    Crear producto
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="productos-container">
                        <tr id="sin-resultados" style="display: none;">
                            <td colspan="7" class="py-4 text-gray-500">
                                Ingrese un término de búsqueda para mostrar productos
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="formularioModal" class="modal hidden">
        <div class="modal-content">
            <h2>Crear Producto</h2>
            <form>
                <input type="text" placeholder="SKU o ID del producto">
                <input type="text" placeholder="Nombre del Producto">
                <input type="text" placeholder="Categoría">
                <input type="number" placeholder="Cantidad">
                <input type="text" placeholder="Precio">
                <input type="text" placeholder="Presentación">
                <input type="text" placeholder="Estado">
                <div class="modal-actions">
                    <button type="submit" class="btn-crear">Crear</button>
                    <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const modal = document.getElementById('formularioModal');
        function mostrarFormulario() {
            modal.classList.remove('hidden');
        }
        function ocultarFormulario() {
            modal.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchBtn = document.querySelector('.btn-buscar');
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