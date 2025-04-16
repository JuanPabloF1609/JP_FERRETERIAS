<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Intro.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">

    <style>
        .btn {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }
        .btn:hover {
            filter: brightness(0.95);
            transform: scale(1.03);
        } 
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        @yield('content')
    </div>

    <!-- Botón de ayuda flotante (inferior derecha) -->
<button id="tutorial-btn" onclick="iniciarTutorial()"
    class="fixed bottom-4 right-4 z-50 bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-700 transition duration-200">
    <span class="text-xl font-bold">?</span>
</button>


    @yield('scripts')
</body>
</html>
