<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Catalogo</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
    @vite(['resources/css/app.css','resources/css/admin/dashboard.css', 'resources/js/app.js'])
</head>
<body class="body">
    @include('ferreteria.components.topbar')
    @include('ferreteria.components.sidebar')
    @include('ferreteria.components.overlay')

    <!-- Botón flotante de ayuda -->
    @include('ferreteria.components.help_floating_button')

    <!-- Botón flotante del carrito -->
    @include('ferreteria.components.cart_floating_button')

    <!-- Modal del carrito -->
    @include('ferreteria.components.cart_modal')

    <!-- Modal de alerta -->
    <div id="alert-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] hidden">
        <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/3 p-6">
            <p id="alert-message" class="text-center text-lg font-semibold mb-4"></p>
            <div id="alert-buttons" class="flex justify-center gap-4">
                <button id="alert-confirm-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Aceptar
                </button>
                <button id="alert-cancel-btn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido principal dinámico -->
    <div class="main-content flex justify-center">
        <div class="w-full max-w-7xl">
            @yield('content')
        </div>
    </div>

    @include('ferreteria.components.bottombar')
    @include('ferreteria.components.scripts_orders')
    @yield('modals')
    @include('ferreteria.components.catalogo_scripts')
</body>
</html>