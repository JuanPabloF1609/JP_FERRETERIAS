{{-- filepath: resources/views/ferreteria/components/orden_cola.blade.php --}}
@if(isset($ordenes) && $ordenes->count())
    <div class="relative h-[370px] w-[270px] mx-auto mt-6">
        @foreach($ordenes as $index => $orden)
            @php
                $scale = 1 - ($index * 0.07);
                // Solo aplica margen a partir de la segunda tarjeta de la cola
                $marginLeft = $index === 0 ? 0 : ($index * 18);
            @endphp
            <div class="absolute transition-all duration-300 orden-cola-container
                {{ $index === 0 ? 'z-30' : ($index === 1 ? 'z-20' : 'z-10') }}
                {{ $index > 2 ? 'hidden' : '' }}
                {{ $index === 1 ? 'blur-[0.5px]' : '' }}
                {{ $index === 2 ? 'blur-[1px]' : '' }}"
                style="
                    left: {{$marginLeft}}px;
                    right: {{$marginLeft}}px;
                    top: {{ $index * 32 }}px;
                    transform: scale({{ $scale }});
                    opacity: {{ 1 - ($index * 0.18) }};
                ">
                <h2 class="orden-cola-title text-gray-800">Orden en cola</h2>
                <div class="orden-cola-content text-gray-700">
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
    </div>
@else
    <div class="orden-cola-container">
        <h2 class="orden-cola-title">Sin órdenes en cola</h2>
    </div>
@endif