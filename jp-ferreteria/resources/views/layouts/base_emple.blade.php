<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/empleado.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <!-- Botón de hamburguesa fuera del sidebar -->
        <button id="toggleSidebar" class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>

        @include('components.sidebar_admin')

        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>

    @yield('modals')

    @yield('scripts')
</body>
</html>
