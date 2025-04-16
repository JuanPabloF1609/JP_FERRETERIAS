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
        @include('components.sidebar_admin')

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    @yield('modals')

    @yield('scripts')
</body>
</html>