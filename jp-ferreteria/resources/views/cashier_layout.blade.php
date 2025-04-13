 <!--Contiene la estructura base del HTML-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .btn {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
            transition: all 0.2s ease-in-out; /* Transición suave */
        }
        .btn:hover {
            filter: brightness(0.95);   /* Oscurecer un  poquito al pasar el mouse */
            transform: scale(1.03);     /* Aumenta el tamaño un poquito al pasar el mouse */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
