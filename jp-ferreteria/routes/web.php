<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\asdasd;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;

// Ruta para el dashboard de productos
Route::get('/dashboard', [ProductoController::class, 'index'])->name('dashboard');

// Ruta para la vista de empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');

// Ruta para la vista de productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos');



Route::get('/cashiermanager', function () {
    return view('cashiermanager');
});



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

