<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
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