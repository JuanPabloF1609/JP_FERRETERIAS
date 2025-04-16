<?php

use App\Http\Controllers\DeliverymanController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;


// Redirigir la ruta raíz al login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

    
Route::get('dashboard', function () {
    return view('dashboard'); // Renderiza tu vista Blade personalizada
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para los productos
Route::get('/productos', [ProductoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('productos');

// Ruta para las órdenes
Route::get('/delivery', [DeliverymanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('delivery.index');

// Ruta para el histórico
Route::get('/historical', function () {
    return view('historical.index'); // Cambia 'historical' por el nombre correcto de tu vista
})->middleware(['auth', 'verified'])->name('historical.index');


// Ruta para el dashboard del cajero
Route::get('/cashier', [CashierController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cashier');

Route::get('/cashiermanager', function () {
      return view('cashiermanager');
})->middleware('auth')->name('cashiermanager');


// Archivos adicionales de configuración
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';