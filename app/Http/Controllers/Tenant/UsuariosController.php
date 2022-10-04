<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Tenant\User as User;
use App\Models\Tenant\Usuario;
use Illuminate\Support\Facades\Session;

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

  /**
   * Función index()
   * Retorna la vista 'index' donde se enlistan los usuarios dados de alta en la base de datos
   */
  public function index()
  {
    $usuarios = User::withTrashed()->get();

    return view('system.empleados.index', [
      'usuarios' => $usuarios,
    ]);
  }

  /**
   * Función showRegister()
   * Retorna la vista de registro de usuarios
   */
  public function showRegister()
  {
    $roles = Rol::limit(2)->get();
    return view('system.empleados.register', [
      'roles' => $roles
    ]);
  }

  /**
   * Función registerUser()
   * Valida los datos de un usuario al registrarlo 
   * y hace la alta de ese usuario en la tabla correspondiente
   * Finalmente retorna a la vista donde se enlistan los usuarios registrados
   */
  public function registerUser(Request $request)
  {
    $request->validate([
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|min:10|max:10',
      'rol' => 'required',
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
      'email' => $request->correo,
      'password' => $request->contraseña,
      'rol_id' => $request->rol,
    ];

    \App\Models\Tenant\User::create($usuario);

    return redirect()->route('tenant.showEmpleados')
      ->with('crear', 'ok');
  }

  /**
   * Función showEditUser()
   * Busca al usuario que se desea editar, obtiene su información 
   * Retorna la vista de edición de usuario junto a la información del usuario seleccionado
   */
  public function showEditUser($usuario_id)
  {
    $usuarioFind = User::withTrashed()->find($usuario_id);
    $roles = Rol::limit(2)->get();

    return view('system.empleados.edit', [
      'usuarioFind' => $usuarioFind,
      'roles' => $roles,
    ]);
  }

  /**
   * Función editUser()
   * Hace las validaciones de los datos ingresados al editar un usuario
   * Y hace la actualización de los datos del usuario editado
   * Finalmente retorna a la vista donde se enlistan los usuarios registrados
   */
  public function editUser(Request $request, $usuario_id)
  {
    $request->validate([
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|min:10|max:10',
      'rol' => 'required',
    ]);

    $usuario = User::withTrashed()->find($usuario_id);
    $usuario->nombre = $request->nombre;
    $usuario->apellido_p = $request->app;
    $usuario->apellido_m = $request->apm;
    $usuario->direccion = $request->direccion;
    $usuario->telefono = $request->telefono;
    $usuario->rol_id = $request->rol;
    $usuario->update();

    return redirect()->route('tenant.showEmpleados')
      ->with('editar', 'ok');
  }

  /**
   * Función deleteUser()
   * Hace la baja lógica del usuario seleccionado
   * Y retorna a la vista donde se enlistan los usuarios registrados
   */
  public function deleteUser($usuario_id)
  {
    $id = (int)$usuario_id;
    User::withTrashed()->find($id)
      ->delete();
    return redirect()->route('tenant.showEmpleados')
      ->with('eliminar', 'ok');
  }

  /**
   * Función activateUser()
   * Hace la activación del usuario seleccionado que previamente 
   * se habia dado de baja de forma lógica
   * Finalmente retorna a la vista donde se enlistan los usuarios registrados
   */
  public function activateUser($usuario_id)
  {
    User::withTrashed()
      ->find($usuario_id)
      ->restore();

    return redirect()->route('tenant.showEmpleados')
      ->with('activar', 'ok');;
  }
}
