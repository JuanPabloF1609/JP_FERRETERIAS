<?php

use App\Http\Controllers\DeliverymanController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;

// Redirigir la ruta raíz al login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

    
Route::get('dash_admin', function () {
    return view('dash_admin'); // Renderiza tu vista Blade personalizada
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para los productos
Route::get('/productos', [ProductoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('productos');

    Route::get('/empleados', [EmpleadoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('empleados');

// Ruta para las órdenes
Route::get('/delivery', [DeliverymanController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('delivery.index');

// Ruta para el histórico
Route::get('/historical', function () {
    return view('historical.index'); // Cambia 'historical' por el nombre correcto de tu vista
})->middleware(['auth', 'verified'])->name('historical.index');


// Ruta para el dashboard del cajero
Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta principal del cajero
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
    
    // Nuevas rutas para el funcionamiento del carrito
    Route::post('/cashier/save-draft', [CashierController::class, 'saveDraft'])->name('cashier.saveDraft');
    Route::post('/cashier/checkout', [CashierController::class, 'checkout'])->name('cashier.checkout');
    Route::get('/cashier/get-drafts', [CashierController::class, 'getDrafts'])->name('cashier.getDrafts');
    Route::get('/cashier/load-draft/{id}', [CashierController::class, 'loadDraft'])->name('cashier.loadDraft');
});

Route::get('/cashiermanager', function () {
    return view('cashiermanager');
})->middleware('auth')->name('cashiermanager');

// Archivos adicionales de configuración
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';