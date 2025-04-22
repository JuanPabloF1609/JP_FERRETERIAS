<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>
<body class="font-sans flex">

    <!-- Botón de hamburguesa fuera del sidebar -->
    <button id="toggleSidebar" class="sidebar-toggle">
        <i class="fas fa-bars"></i>
    </button>

    @include('components.sidebar_admin')

    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    @yield('modals')

    {{-- Asegúrate de que este include esté dentro de @section('scripts') si modularizas --}}
    @yield('scripts')
</body>
</html>
