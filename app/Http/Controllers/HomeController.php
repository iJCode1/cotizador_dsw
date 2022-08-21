<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Roles;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $id = Auth::user()->id; // ID del usuario logueado
      // Consulta entre 2 tablas - Users y Roles
      $consulta = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();
      echo($consulta);
      return view('home', ['user' => $consulta]);
    }
}
