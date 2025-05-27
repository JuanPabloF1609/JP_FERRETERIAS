{{-- filepath: resources/views/ferreteria/components/orden_activa.blade.php --}}
@if($orden)
<div class="orden-activa-container">
    <h2 class="orden-activa-title">Orden activa</h2>
    <div class="orden-activa-content">
        <p><strong>Nombre Cliente:</strong> {{ $orden->factura->cliente->NOMBRE_CLIENTE }}</p>
        <p><strong>Dirección:</strong> {{ $orden->DIRECCION_ENTREGA }}</p>
        <p><strong>Productos:</strong> {{ $orden->factura->productos->count() }}</p>
        <p><strong>Cantidad de Viajes:</strong> 1</p>
        <p class="mt-2"><strong>Descripción:</strong>
            @foreach($orden->factura->productos as $producto)
                {{ $producto->NOMBRE_PRODUCTO }} ({{ $producto->pivot->CANTIDAD }}),
            @endforeach
        </p>
        <form action="{{ route('orders.entregar', $orden->ID_ORDEN) }}" method="POST">
            @csrf
            <button type="submit" class="btn-entregar"
                data-intro="Este botón marca la orden como entregada y la mueve al historial."
                data-title="Botón de entrega" data-step="1">
                <strong>Entregado</strong>
            </button>
        </form>
    </div>
</div>
@else
<div class="orden-activa-container">
    <h2 class="orden-activa-title">Sin orden activa</h2>
</div>
@endif