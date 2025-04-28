<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Ruta dashboard unificada
Route::get('dashboard', [DashboardController::class, 'handleDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Rutas protegidas por permisos
    Volt::route('users', 'admin.users.index')
        ->name('admin.users.index')
        ->middleware('can:view_users');
        
    Volt::route('users/create', 'users.create')
        ->name('users.create')
        ->middleware('can:edit_users');
        
    Volt::route('users/{user}/edit', 'users.edit')
        ->name('users.edit')
        ->middleware('can:edit_users');
    Volt::route('products', 'admin.products.index')->name('admin.products.index')->middleware('can:view_products');
    Volt::route('categories', 'admin.categories.index')->name('admin.categories.index')->middleware('can:view_categories');
    Volt::route('bills', 'bills.index')->name('admin.bills.index')->middleware('can:view_bill');
    Volt::route('delivery-orders', 'admin.delivery-orders.index')->name('admin.delivery-orders.index')->middleware('can:view_delivery_order');
});

require __DIR__.'/auth.php';