@extends('layouts.base_dashadmin')

@section('title', 'Dashboard - Estadísticas')

@section('content')
<div class="container">
    <h1 class="mb-6 text-center text-2xl font-bold text-gray-800">Panel de Administración</h1>
    @can('view_admin_dashboard')
    
        @include('components.stats_admin')

    @endcan
</div>
@endsection