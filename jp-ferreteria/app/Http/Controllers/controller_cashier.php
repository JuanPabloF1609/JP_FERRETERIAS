<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_cashier extends Controller
{
    public function index()
    {
        // Aquí puedes pasar datos reales a la vista si lo necesitas
        return view('cashiermanager');
    }
}
