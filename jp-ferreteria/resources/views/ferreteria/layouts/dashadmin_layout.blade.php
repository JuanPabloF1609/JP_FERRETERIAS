<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Gestión')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css','resources/css/admin/dashboard.css', 'resources/js/app.js'])

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body class="body">

    @include('ferreteria.components.alert_banner')
    @include('ferreteria.components.topbar')
    @include('ferreteria.components.sidebar')
    @include('ferreteria.components.overlay')

    <!-- Contenido principal dinámico -->
    <div class="main-content">
        @yield('content')
    </div>

    @include('ferreteria.components.bottombar')
    @include('ferreteria.components.scripts_orders')

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        let alertasPrevias = 0;

        function actualizarAlertas() {
            fetch('{{ route('admin.alertasPendientes') }}')
                .then(res => res.json())
                .then(alertas => {
                    const badge = document.getElementById('alertas-badge');
                    const banner = document.getElementById('alert-banner');
                    const alertCount = document.getElementById('alert-count');
                    if (alertas.length > 0) {
                        badge.textContent = alertas.length;
                        badge.style.display = 'inline-block';
                        alertCount.textContent = alertas.length;
                        banner.classList.remove('hidden');
                        // Mostrar toast solo si hay más alertas que antes
                        if (alertas.length > alertasPrevias) {
                            toastr.warning('¡Nueva alerta de inventario!', 'Alerta de Stock');
                        }
                    } else {
                        badge.style.display = 'none';
                        banner.classList.add('hidden');
                    }
                    alertasPrevias = alertas.length;
                });
        }

        setInterval(actualizarAlertas, 10000); // Cada 10 segundos
        document.addEventListener('DOMContentLoaded', actualizarAlertas);
    </script>

</body>
</html>