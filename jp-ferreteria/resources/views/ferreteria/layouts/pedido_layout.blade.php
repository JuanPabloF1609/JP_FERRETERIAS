<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de pedidos</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
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
    @yield('modals')
    @include('ferreteria.components.pedido_scripts')

</body>
</html>