<?php

namespace App\Http\Controllers\Tenant\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterCustomerController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  // use RegistersUsers;
  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
    $this->middleware('guest:cliente');
  }

  /**
   * Función showRegistrationForm()
   * Muestra el formulario de registro de cliente
   *
   * @return \Illuminate\Http\Response
   */
  public function showRegistrationForm()
  {
    return view('system.clientes.register');
  }

  /**
   * Función registerCustomer()
   * Valida los datos de un cliente al registrarse 
   * Hace la alta de ese cliente en la tabla correspondiente
   * Finalmente retorna a la vista de login
   */
  public function registerCustomer(Request $request)
  {
    $request->validate([
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|min:10|max:10',
      'correo' => 'required|email|unique:tenant.clientes,email',
      'contraseña' => 'required|digits_between:8,45',
      'confirmar_contraseña' => 'required|digits_between:8,45',
    ]);

    $contraseñaEncriptada = Hash::make($request->contraseña);

    $cliente = [
      'nombre' => $request->nombre,
      'apellido_p' => $request->app,
      'apellido_m' => $request->apm,
      'direccion' => $request->direccion,
      'telefono' => $request->telefono,
      'email' => $request->correo,
      'password' => $contraseñaEncriptada,
      'rol_id' => 3,
    ];

    Cliente::create($cliente);

    return redirect()->route('tenant.login')
      ->with('url', 'cliente')
      ->with('cliente', 'ok');
  }
}
