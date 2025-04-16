<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <link href="{{ asset('css/empleado.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/empleado.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="/empleados" class="active">
                            <i class="fas fa-user"></i>
                            <span>Empleados</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard">
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
                <h1>Gestión de empleados</h1>

                <div class="stats">
                    <div class="stat-card">
                        <i class="fas fa-user icon"></i>
                        <p class="label">Empleados activos:</p>
                        <p class="value">{{ $activos }}</p>
                    </div>

                    <div class="stat-card">
                        <i class="fas fa-user-slash icon"></i>
                        <p class="label">Empleados Inactivos:</p>
                        <p class="value">{{ $inactivos }}</p>
                    </div>
                </div>

                <div class="search-section">
                    <input type="text" placeholder="Buscar empleado por nombre o ID">
                    <button class="btn-buscar">Buscar</button>
                </div>

                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>ID</th>
                                <th>ROL</th>
                                <th>ESTADO</th>
                                <th>
                                    <button onclick="mostrarFormulario()" class="btn-crear">Crear empleado</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí irían los empleados dinámicos -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal para crear empleado -->
    <div id="formularioModal" class="modal hidden">
        <div class="modal-content">
            <h2>Crear Empleado</h2>
            <form>
                <input type="text" placeholder="Primer Nombre" required>
                <input type="text" placeholder="Segundo Nombre">
                <input type="text" placeholder="Primer Apellido" required>
                <input type="text" placeholder="Segundo Apellido">
                <input type="email" placeholder="Correo" required>
                <input type="text" placeholder="Rol" required>
                <input type="text" placeholder="Estado" required>
                <div class="modal-actions">
                    <button type="submit" class="btn-crear">Crear</button>
                    <button type="button" onclick="ocultarFormulario()" class="btn-cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts para el modal -->
    <script>
        const modal = document.getElementById('formularioModal');
        function mostrarFormulario() {
            modal.classList.remove('hidden');
        }
        function ocultarFormulario() {
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>