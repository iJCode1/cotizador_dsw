<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Tenant\User as User;

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
    $this->middleware('adminEmpresa');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Función index()
   * Retorna la vista 'index' 
   * vista donde se enlistan los usuarios internos dados de alta en la base de datos
   */
  public function index()
  {
    $usuarios = User::withTrashed()->latest()->paginate(10);

    return view('system.empleados.index', [
      'usuarios' => $usuarios,
    ]);
  }

  /**
   * Función showRegister()
   * Retorna la vista con el formulario para el registro de usuarios internos
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
   * Válida los datos introducidos en el formulario
   * Si los datos no son válidos, retorna a la vista anterior y muestra errores
   * Si los datos son válidos hace el alta de ese usuario en la tabla correspondiente
   * Finalmente retorna a la vista donde se enlistan los usuarios registrados
   */
  public function registerUser(Request $request)
  {
    $rules = [
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|numeric|digits_between:10,10',
      'rol' => 'required',
      'correo' => 'required|email|max:100|unique:tenant.users,email|unique:tenant.clientes,email',
      'contraseña' => 'required|min:8|max:50',
    ];

    $customMessages = [
      'nombre.required' => 'El nombre es obligatorio.',
      'nombre.max' => 'El nombre no debe contener más de 45 caracteres.',
      'app.required' => 'El apellido paterno es obligatorio.',
      'app.max' => 'El apellido paterno no debe contener más de 45 caracteres.',
      'apm.required' => 'El apellido materno es obligatorio.',
      'apm.max' => 'El apellido materno no debe contener más de 45 caracteres.',
      'direccion.required' => 'La dirección es obligatoria.',
      'direccion.max' => 'La dirección no debe contener más de 255 caracteres.',
      'telefono.required' => 'El teléfono es obligatorio.',
      'telefono.numeric' => 'El teléfono solo acepta valores numéricos.',
      'telefono.digits_between' => 'El teléfono debe ser de 10 dígitos.',
      'rol.required' => 'Se debe seleccionar el tipo de usuario (rol).',
      'correo.required' => 'El correo es obligatorio.',
      'correo.email' => 'El formato del correo es incorrecto.',
      'correo.max' => 'El correo no debe contener más de 100 caracteres.',
      'correo.unique' => 'El correo ingresado ya está registrado.',
      'contraseña.required' => 'La contraseña es obligatoria.',
      'contraseña.min' => 'La contraseña debe contener al menos 8 caracteres.',
      'contraseña.max' => 'La contraseña no debe contener más de 50 caracteres.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect('/empleado')
        ->withErrors($validator)
        ->withInput();
    } else {
      $contraseñaEncriptada = Hash::make($request->contraseña);

      $usuario = [
        'nombre' => $request->nombre,
        'apellido_p' => $request->app,
        'apellido_m' => $request->apm,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'email' => $request->correo,
        'password' => $contraseñaEncriptada,
        'rol_id' => $request->rol,
      ];

      User::create($usuario);

      return redirect()->route('tenant.showEmpleados')
        ->with('crear', 'ok');
    }
  }

  /**
   * Función showUser()
   * Busca al usuario del cual se desea ver su información
   * Retorna la vista de info de usuario junto a la información
   */
  public function showUser($usuario_id)
  {
    $usuarioFind = User::withTrashed()->find($usuario_id);
    $roles = Rol::limit(2)->get();

    return view('system.empleados.info', [
      'usuarioFind' => $usuarioFind,
      'roles' => $roles,
    ]);
  }

  /**
   * Función showEditUser()
   * Busca al usuario que se desea editar y obtiene su información 
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
   * Si los datos no son válidos, regresa a la vista anterior y muestra los errores
   * Si los datos son válidos hace la actualización de los datos del usuario editado
   * Finalmente retorna a la vista donde se enlistan los usuarios registrados
   */
  public function editUser(Request $request, $usuario_id)
  {
    $rules = [
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|numeric|digits_between:10,10',
      'rol' => 'required',
    ];

    $customMessages = [
      'nombre.required' => 'El nombre es obligatorio.',
      'nombre.max' => 'El nombre no debe contener más de 45 caracteres.',
      'app.required' => 'El apellido paterno es obligatorio.',
      'app.max' => 'El apellido paterno no debe contener más de 45 caracteres.',
      'apm.required' => 'El apellido materno es obligatorio.',
      'apm.max' => 'El apellido materno no debe contener más de 45 caracteres.',
      'direccion.required' => 'La dirección es obligatoria.',
      'direccion.max' => 'La dirección no debe contener más de 255 caracteres.',
      'telefono.required' => 'El teléfono es obligatorio.',
      'telefono.numeric' => 'El teléfono solo acepta valores numéricos.',
      'telefono.digits_between' => 'El teléfono debe ser de 10 dígitos.',
      'rol.required' => 'Se debe seleccionar el tipo de usuario (rol).',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/empleado/$usuario_id/edit")
        ->withErrors($validator)
        ->withInput();
    } else {
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
   * se había dado de baja de forma lógica
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
