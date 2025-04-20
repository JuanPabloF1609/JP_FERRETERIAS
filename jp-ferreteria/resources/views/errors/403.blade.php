<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-black text-yellow-400 min-h-screen flex flex-col items-center justify-center">


    <div class="w-full bg-yellow-400 py-1">
        <div class="h-4 bg-repeat-x" style="background-image: repeating-linear-gradient(
            45deg,
            black 0 10px,
            yellow 10px 20px
        );"></div>
    </div>


    <div class="text-6xl mt-10 my-4">
        🔧 🛠️ 🪓
    </div>


    <h1 class="text-9xl font-black tracking-widest drop-shadow-lg">403</h1>
    <h2 class="text-2xl mt-4 font-bold">Acceso Denegado</h2>
    <p class="text-yellow-300 mt-2 text-center max-w-md">
        ¡Uy! No tienes permiso para ver este recurso. 
        Por favor, regresa al inicio o contacta al administrador.
    </p>


    <a href="{{ url('/dashboard') }}"
       class="mt-9 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 mb-10 rounded transition duration-300">
        Volver al Dashboard
    </a>

    <div class="w-full  bg-yellow-400 py-1">
        <div class="h-5 bg-repeat-x" style="background-image: repeating-linear-gradient(
            45deg,
            black 0 10px,
            yellow 10px 20px
        );"></div>
    </div>

</body>
</html>
