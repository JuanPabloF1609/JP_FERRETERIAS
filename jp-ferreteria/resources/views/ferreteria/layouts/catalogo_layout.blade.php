<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
    @vite(['resources/css/app.css','resources/css/admin/dashboard.css', 'resources/js/app.js'])

</head>
<body class="body">
    @include('ferreteria.components.topbar')
    @include('ferreteria.components.sidebar')
    @include('ferreteria.components.overlay')

    <!-- Contenido principal dinámico -->
    <div class="main-content">
        @yield('content')
    </div>

    @include('ferreteria.components.bottombar')
    @include('ferreteria.components.scripts_orders')

</body>
</html>