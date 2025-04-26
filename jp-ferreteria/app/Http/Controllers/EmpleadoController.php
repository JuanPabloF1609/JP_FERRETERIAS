<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {

        $activos = 10; 
        $inactivos = 5; 

        return view('ferreteria.users.empleado', compact('activos', 'inactivos'));
    }
}