<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Rutas para las vistas de repartidor
Route::middleware(['auth', 'can:view_delivery_dashboard'])->group(function () {
    Route::view('/orders', 'ferreteria.orders.orders')->name('delivery.index');
    Route::view('/historical', 'ferreteria.orders.historical')->name('historical.index');
});

//Rutas para las vistas de administrador
Route::middleware(['auth', 'can:view_admin_dashboard'])->group(function () {
    Route::view('/dash_admin', 'ferreteria.products.dash_admin')->name('admin.dash');
    Route::get('/productos', [ProductoController::class, 'index'])->name('admin.product');
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('admin.employee');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/buscar', [ProductoController::class, 'buscar']);
    Route::put('/productos/{producto}/disable', [ProductoController::class, 'disable'])->name('productos.disable');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::put('/productos/{producto}/enable', [ProductoController::class, 'enable'])->name('productos.enable');
});

//Rutas para las vistas de caja
Route::middleware(['auth', 'can:view_caja_dashboard'])->group(function () {
    Route::get('/pedidos', [CatalogoController::class, 'pedidos'])->name('caja.pedidos');
    Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
    // Ruta para finalizar la compra
    Route::post('/finalizar-compra', [CatalogoController::class, 'finalizarCompra'])->name('catalogo.finalizarCompra');
    // Ruta para crear una venta desde el modal
    Route::post('/ventas/crear', [CatalogoController::class, 'crearVenta'])->name('ventas.crear');
    // Ruta para editar una venta
    Route::put('/ventas/editar', [CatalogoController::class, 'editarVenta'])->name('ventas.editar');
});

// Ruta para la vista de categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::patch('/categories/{id}/disable', [CategoryController::class, 'disable'])->name('category.disable');


Route::get('/ventas/{id}/toggle', [CatalogoController::class, 'toggleEstadoVenta'])->name('ventas.toggle')->middleware('can:disable_bill');

require __DIR__.'/auth.php';
