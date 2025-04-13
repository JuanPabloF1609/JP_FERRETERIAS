@extends('layouts.dashboard_delivery_layout')

@section('title', 'Dashboard Repartidor')

@section('content')
    <div class="bg-white w-[900px] h-[540px] rounded-[10px] p-6 shadow-md overflow-auto">
        <h1 class="text-center text-xl font-bold mb-6">ORDENES</h1>
        <div class="flex flex-col lg:flex-row lg:justify-center gap-8 items-center">
            @include('partials.orden_activa')
            @include('partials.orden_cola')
        </div>
    </div>
@endsection
