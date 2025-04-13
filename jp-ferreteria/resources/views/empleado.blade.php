<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <link href="{{ asset('css/empleado.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/empleado.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <h1>Gestion de empleados</h1>

        <div class="stats">
            <div class="stat-card">
                <i class="fas fa-user icon"></i>
                <p class="label">Empleados activos:</p>
                <p class="value">{{ $activos }}</p>
            </div>

            <div class="stat-card">
                <i class="fas fa-user-slash icon"></i>
                <p class="label">Empleados Inactivos:</p>
                <p class="value">{{ $inactivos }}</p>
            </div>
        </div>

        <div class="search-section">
            <input type="text" placeholder="Buscar empleado por nombre o ID">
            <button class="btn-buscar">Buscar</button>
        </div>

        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>ID</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th>
                            <button class="btn-crear">Crear empleado</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí irían los empleados dinámicos -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
