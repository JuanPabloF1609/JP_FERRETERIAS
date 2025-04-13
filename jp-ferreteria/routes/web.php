<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;

// Ruta para el dashboard de productos
Route::get('/dashboard', [ProductoController::class, 'index'])->name('dashboard');

// Ruta para la vista de empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');
