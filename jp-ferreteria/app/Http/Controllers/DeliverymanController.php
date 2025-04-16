<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliverymanController extends Controller
{
    /**
     * Muestra el dashboard del repartidor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('delivery.index');
    }
}
