<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Rol;
use App\Models\Tenant\User as User2;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  protected $tenantName = null;

  public function __construct()
  {
    $this->middleware('auth');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if (!$this->tenantName) {
      $id = Auth::user()->id; // ID del usuario logueado
      // Consulta entre 2 tablas - Users y Roles
      $consulta = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
        ->select('users.name', 'roles.nombre_rol AS NombreRol')
        ->where('users.id', "=", $id)
        ->get();
      // echo($id);
      echo(Auth::user());
      echo($consulta);
      return view('home', ['user' => $consulta]);
    } else {
      $id = Auth::user()->id; // ID del usuario logueado
      // Consulta entre 2 tablas - Users y Roles
      $consulta = User2::join('roles', 'users.rol_id', '=', 'roles.rol_id')
        ->select('users.name', 'roles.nombre_rol AS NombreRol')
        ->where('users.id', "=", $id)
        ->get();
      // echo($id);
      echo(Auth::user());
      echo "</br>";
      echo($consulta);
      return view('home', ['user' => $consulta]);
    }
  }
}
