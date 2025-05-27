<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
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
                        badge && (badge.textContent = alertas.length, badge.style.display = 'inline-block');
                        alertCount && (alertCount.textContent = alertas.length);
                        banner && banner.classList.remove('hidden');
                    } else {
                        badge && (badge.style.display = 'none');
                        banner && banner.classList.add('hidden');
                    }
                    alertasPrevias = alertas.length;
                });
        }
        setInterval(actualizarAlertas, 10000);
        document.addEventListener('DOMContentLoaded', actualizarAlertas);
    </script>
</body>
</html>