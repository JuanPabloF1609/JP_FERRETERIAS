<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gestión de Roles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fuentes e iconos -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/rol.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-50 text-gray-800">
    <div class="flex h-screen">
     

        <!-- Contenido principal -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('title', 'Gestión de Roles')</h1>
                    <!-- Aquí podrías añadir elementos de navegación superior -->
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('modals')
    @yield('scripts')
</body>
</html>