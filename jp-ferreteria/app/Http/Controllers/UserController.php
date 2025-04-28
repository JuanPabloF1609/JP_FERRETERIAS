<?php

   namespace App\Http\Controllers;

   use App\Models\User;
   use Illuminate\Http\Request;

   class UserController extends Controller
   {
       public function index(Request $request)
       {
           // Contar empleados activos e inactivos
           $activeEmployees = User::where('status', 'active')->count();
           $inactiveEmployees = User::where('status', 'inactive')->count();

           // Filtrar empleados por nombre o ID
           $search = $request->input('search');
           $users = User::query()
               ->when($search, function ($query, $search) {
                   return $query->where('name', 'like', "%{$search}%")
                               ->orWhere('id', 'like', "%{$search}%");
               })
               ->get();

           return view('users', [
               'activeEmployees' => $activeEmployees,
               'inactiveEmployees' => $inactiveEmployees,
               'users' => $users,
               'search' => $search,
           ]);
       }
   }