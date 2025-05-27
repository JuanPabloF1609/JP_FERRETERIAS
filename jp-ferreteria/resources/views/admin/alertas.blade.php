{{-- filepath: resources/views/admin/alertas.blade.php --}}
@extends('ferreteria.layouts.dashadmin_layout')

@section('title', 'Alertas de Inventario')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Alertas de Inventario</h1>
    @if($alertas->count())
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2">Producto</th>
                    <th class="px-4 py-2">Comentario</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alertas as $alerta)
                    <tr>
                        <td class="border px-4 py-2">{{ $alerta->producto->NOMBRE_PRODUCTO ?? 'Sin producto' }}</td>
                        <td class="border px-4 py-2">{{ $alerta->COMENTARIO }}</td>
                        <td class="border px-4 py-2">{{ $alerta->FECHA_ALERTA }}</td>
                        <td class="border px-4 py-2">{{ $alerta->ESTADO_ALERTA }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded flex items-center justify-between">
            <span>Para solucionar las alertas, agrega más productos o repón el inventario.</span>
            <a href="{{ route('admin.product') }}" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Ir a productos</a>
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            No hay alertas de inventario pendientes.
        </div>
    @endif
</div>
@endsection