<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    @vite('resources/css/app.css', 'resources/js/app.js')

    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css" />

    <!-- Intro.js JS -->
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
</head>
<body class="body">

    <!-- Topbar -->
    @include('components.topbar')

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Overlay -->
    @include('components.overlay')

    <!-- Contenido principal dinámico -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bottombar -->
    @include('components.bottombar')

    <!-- Scripts -->
    @include('components.scripts')

</body>
</html>
