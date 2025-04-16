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
    @include('components.sidebar_admin')
    
    <main class="main-content">
        @yield('content')
    </main>

    @yield('modals')
    @include('components.scripts_produ')

</body>
</html>