<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EmpleadoController extends Controller
{
    public function index()
    {
        // Valores estáticos de prueba
        $activos = 7;
        $inactivos = 3;

        return view('empleado', compact('activos', 'inactivos'));
    }


}
// // Ruta para el dashboard de empleados
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');

