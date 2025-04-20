<?php

use App\Http\Controllers\DeliverymanController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;

// Ruta para la vista de inicio de sesión
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Ruta para el dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard'); 
})->middleware(['auth', 'verified',])->name('dashboard');

// Ruta para el dashboard del administrador  
Route::get('dash_admin', function () {
    return view('dash_admin');
})->middleware(['auth', 'verified','can:view_admin_dashboard'])->name('dash_admin');

// Ruta para los productos
Route::get('/productos', [ProductoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('productos');

// Ruta para los usuarios
Route::get('/empleados', [EmpleadoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('empleados');

// Ruta para las órdenes
Route::get('/delivery', [DeliverymanController::class, 'index'])
    ->middleware(['auth', 'verified','can:view_delivery_dashboard'])
    ->name('delivery.index');

// Ruta para el histórico
Route::get('/historical', function () {
    return view('historical.index'); 
})->middleware(['auth', 'verified'])->name('historical.index');


// Ruta para el dashboard del cajero
Route::get('/cashier', [CashierController::class, 'index'])
    ->middleware(['auth', 'verified','can:view_caja_dashboard'])
    ->name('cashier');

// Ruta para la vista de gestion de productos
Route::get('/cashiermanager', function () {
      return view('cashiermanager');
})->middleware(['auth', 'verified','can:view_caja_dashboard' ])->name('cashiermanager');


// Archivos adicionales de configuración
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';