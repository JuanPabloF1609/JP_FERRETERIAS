<!-- Contenedor de orden activa -->
<div class="orden-activa-container">
    <h2 class="orden-activa-title">Orden activa</h2>
    <div class="orden-activa-content">
        @if($ordenActiva)
            <p><strong>Nombre Cliente:</strong> {{ $ordenActiva->factura->cliente->NOMBRE_CLIENTE ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $ordenActiva->DIRECCION_ENTREGA }}</p>
            <p><strong>Teléfono:</strong> {{ $ordenActiva->factura->cliente->TELEFONO_CLIENTE ?? 'N/A' }}</p>
            <p><strong>Productos:</strong> {{ $ordenActiva->factura->productos->count() }}</p>
            <button id="btn-entregar" class="btn-entregar" data-orden-id="{{ $ordenActiva->ID_ORDEN }}">
                <strong>Entregado</strong>
            </button>
        @else
            <p>No hay órdenes activas.</p>
        @endif
    </div>
</div>