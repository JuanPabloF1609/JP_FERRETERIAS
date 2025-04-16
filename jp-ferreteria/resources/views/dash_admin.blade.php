@extends('layouts.base_dashadmin')

@section('title', 'Dashboard - Estadísticas')

@section('content')
<div class="container">
    <h1 class="mb-6 text-center text-2xl font-bold text-gray-800">Estadísticas</h1>
    @include('components.stats_admin')

    
</div>
@endsection