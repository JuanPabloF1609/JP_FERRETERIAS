{{-- filepath: resources/views/ferreteria/components/orden_cola.blade.php --}}
@if(isset($ordenes) && $ordenes->count())
    @foreach($ordenes as $orden)
        <div class="orden-cola-container">
            <h2 class="orden-cola-title">Orden en cola</h2>
            <div class="orden-cola-content">
                <p><strong>Nombre Cliente:</strong> {{ $orden->factura->cliente->NOMBRE_CLIENTE ?? 'Sin cliente' }}</p>
                <p><strong>Dirección:</strong> {{ $orden->DIRECCION_ENTREGA }}</p>
                <p><strong>Productos:</strong> {{ $orden->factura->productos->count() }}</p>
                <p><strong>Cantidad de Viajes:</strong> 1</p>
                <p class="mt-2"><strong>Descripción:</strong>
                    @foreach($orden->factura->productos as $producto)
                        {{ $producto->NOMBRE_PRODUCTO }} ({{ $producto->pivot->CANTIDAD }}),
                    @endforeach
                </p>
            </div>
        </div>
    @endforeach
@else
    <div class="orden-cola-container">
        <h2 class="orden-cola-title">Sin órdenes en cola</h2>
    </div>
@endif