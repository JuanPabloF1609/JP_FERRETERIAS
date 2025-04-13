<?php

use App\Http\Controllers\DeliverymanController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-delivery', [DeliverymanController::class, 'index'])->name('dashboard.delivery');

Route::get('/historico-delivery', function () {
    return view('Historico_delivery_man');
})->name('delivery.historico');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
