<?php

use App\Http\Controllers\DeliverymanController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;

// Ruta para el dashboard de productos
Route::get('/dash_admin', [AdminController::class, 'index'])->name('admin_dashboard');

// Ruta para la vista de empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');

// Ruta para la vista de productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

// Ruta para el dashboard de cashier
Route::get('/dash_cashier', [CashierController::class, 'index'])->name('dash_cashier');

// Ruta para la gestión de ventas del cashier
Route::get('/cashiermanager', function () {
    return view('cashiermanager');
})->middleware('auth')->name('cashiermanager');

// Redirigir la ruta raíz al login
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Ruta para el dashboard (puedes mantenerla si la necesitas para otros roles)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/delivery', [DeliverymanController::class, 'index'])->name('delivery.index');

Route::get('/historical', function () {
    return view('historical.index');
})->name('historical.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';