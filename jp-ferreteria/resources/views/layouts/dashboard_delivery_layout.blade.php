<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    @include('partials.topbar')
    @include('partials.sidebar')
    @include('partials.overlay')

    <!-- Contenido principal dinámico -->
    <div class="pt-20 pb-20 flex justify-center">
        @yield('content')
    </div>

    @include('partials.bottombar')
    @include('partials.scripts')

</body>
</html>
