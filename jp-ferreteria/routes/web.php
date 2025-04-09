<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

// Ruta pública
Route::get('/', fn () => Inertia::render('Welcome'));

// Rutas protegidas con autenticación
Route::middleware(['auth', ValidateSessionWithWorkOS::class])->group(function () {
    // Ruta del dashboard (accesible para todos los usuarios autenticados)
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Rutas para usuarios con permisos específicos
    Route::middleware('can:view_users')->group(function () {
        Route::get('users', fn () => Inertia::render('Users/Index'))->name('users.index');
        Route::get('users/create', fn () => Inertia::render('Users/Create'))->name('users.create');
    });

    Route::middleware('can:view_products')->group(function () {
        Route::get('products', fn () => Inertia::render('Products/Index'))->name('products.index');
        Route::get('products/create', fn () => Inertia::render('Products/Create'))->name('products.create');
    });

    Route::middleware('can:view_categories')->group(function () {
        Route::get('categories', fn () => Inertia::render('Categories/Index'))->name('categories.index');
        Route::get('categories/create', fn () => Inertia::render('Categories/Create'))->name('categories.create');
    });

    Route::middleware('can:view_delivery_order')->group(function () {
        Route::get('delivery-orders', fn () => Inertia::render('DeliveryOrders/Index'))->name('delivery_orders.index');
        Route::get('delivery-orders/create', fn () => Inertia::render('DeliveryOrders/Create'))->name('delivery_orders.create');
    });

    Route::middleware('can:view_bill')->group(function () {
        Route::get('bills', fn () => Inertia::render('Bills/Index'))->name('bills.index');
        Route::get('bills/create', fn () => Inertia::render('Bills/Create'))->name('bills.create');
    });
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';