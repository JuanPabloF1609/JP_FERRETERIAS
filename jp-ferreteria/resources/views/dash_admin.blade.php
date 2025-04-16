<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Estadísticas</title>
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
                    <a href="/productos">
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
            <h1 class="mb-6 text-center text-2xl font-bold text-gray-800">Estadísticas</h1>

            <!-- Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                    <p class="value text-3xl font-bold text-gray-800">150</p>
                    <p class="label text-sm text-gray-600">Ventas hoy</p>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
                        <i class="fas fa-box-open text-white text-xl"></i>
                    </div>
                    <p class="value text-3xl font-bold text-gray-800">320</p>
                    <p class="label text-sm text-gray-600">Productos vendidos</p>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                    <p class="value text-3xl font-bold text-gray-800">15</p>
                    <p class="label text-sm text-gray-600">Inventario bajo</p>
                </div>
                <div class="stat-card bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-500 mb-4">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <p class="value text-3xl font-bold text-gray-800">8</p>
                    <p class="label text-sm text-gray-600">Clientes nuevos</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>