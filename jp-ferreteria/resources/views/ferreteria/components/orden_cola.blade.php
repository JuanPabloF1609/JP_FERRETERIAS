<!-- Contenedor de orden en cola -->
<div class="orden-cola-container">
    <h2 class="orden-cola-title">Orden en cola</h2>
    <div class="orden-cola-content">
        @forelse($ordenesCola as $orden)
            <div class="mb-4 border-b pb-2">
                <p><strong>Cliente:</strong> {{ $orden->factura->cliente->NOMBRE_CLIENTE ?? 'N/A' }}</p>
                <p><strong>Dirección:</strong> {{ $orden->DIRECCION_ENTREGA }}</p>
                <p><strong>Teléfono:</strong> {{ $orden->factura->cliente->TELEFONO_CLIENTE ?? 'N/A' }}</p>
                <p><strong>Productos:</strong> {{ $orden->factura->productos->count() }}</p>
            </div>
        @empty
            <p>No hay órdenes en cola.</p>
        @endforelse
    </div>
</div>