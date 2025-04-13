<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\asdasd;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');



Route::get('/cashiermanager', function () {
    return view('cashiermanager');
});



Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
