<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css" />
    <!-- Intro.js JS -->
    <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
</head>
<body class="body">

    @include('components.topbar')
    @include('components.sidebar')
    @include('components.overlay')

    <!-- Contenido principal dinámico -->
    <div class="main-content">
        @yield('content')
    </div>

    @include('components.bottombar')
    @include('components.scripts')

</body>
</html>
