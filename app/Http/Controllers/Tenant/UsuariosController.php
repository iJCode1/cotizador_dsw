<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Tenant\User as User;
use App\Models\Tenant\Usuario;

class UsuariosController extends Controller
{

  protected $tenantName = null;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('adminEmpresa');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  public function showRegister(){
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
    ->select('users.name', 'roles.nombre_rol AS NombreRol')
    ->where('users.id', "=", $id)
    ->get();
    
    // dd($user[0]);

    return view('system.empleados.register', [
      'user' => $user
    ]);
    return "Hola";
  }

  public function registerUser(Request $request){
    
    $request->validate([
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|min:10|max:10',
      'correo' => 'required|email|unique:tenant.usuarios,correo_electronico',
      'contraseña' => 'required|digits_between:8,45',
      'confirmar_contraseña' => 'required|digits_between:8,45',
    ]);

    $usuario = [
      'nombre' => $request->nombre,
      'apellido_p' => $request->app,
      'apellido_m' => $request->apm,
      'direccion' => $request->direccion,
      'telefono' => $request->telefono,
      'correo_electronico' => $request->correo,
      'contraseña' => $request->contraseña,
      'rol_id' => 2,
    ];

    \App\Models\Tenant\Usuario::create($usuario);

    return redirect()->route('tenant.showEmpleados');

  }

  public function index(){
    $usuarios = Usuario::withTrashed()->get();
    // $usuarios = Usuario::all();
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
    ->select('users.name', 'roles.nombre_rol AS NombreRol')
    ->where('users.id', "=", $id)
    ->get();

    return view('system.empleados.index', [
      'user' => $user,
      'usuarios' => $usuarios,
    ]);
  }

  public function deleteUser($usuario_id){
    // dd($usuario_id);
    Usuario::find($usuario_id)
            ->delete();
    
    return redirect()->route('tenant.showEmpleados');
  }

  public function activateUser($usuario_id){
    Usuario::withTrashed()
            ->find($usuario_id)
            ->restore();

    return redirect()->route('tenant.showEmpleados');
  }

  public function showEditUser($usuario_id){
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
    ->select('users.name', 'roles.nombre_rol AS NombreRol')
    ->where('users.id', "=", $id)
    ->get();

    $usuarioFind = Usuario::withTrashed()->find($usuario_id);
    // $usuarioFind = Usuario::find($usuario_id);

    return view('system.empleados.edit', [
      'user' => $user, 
      'usuarioFind' => $usuarioFind,
    ]);
  }

  public function editUser(Request $request, $usuario_id){

    $request->validate([
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|min:10|max:10',
    ]);

    $usuario = Usuario::withTrashed()->find($usuario_id);
    $usuario->nombre = $request->nombre;
    $usuario->apellido_p = $request->app;
    $usuario->apellido_m = $request->apm;
    $usuario->direccion = $request->direccion;
    $usuario->telefono = $request->telefono;
    $usuario->update();

    return redirect()->route('tenant.showEmpleados');
  }

}
