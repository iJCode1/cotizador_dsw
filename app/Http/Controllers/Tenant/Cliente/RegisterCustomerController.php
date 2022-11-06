<?php

namespace App\Http\Controllers\Tenant\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cliente;
use Illuminate\Support\Facades\Validator;
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
    $rules = [
      'nombre' => 'required|max:45',
      'app' => 'required|max:45',
      'apm' => 'required|max:45',
      'direccion' => 'required|max:255',
      'telefono' => 'required|numeric|digits_between:10,10',
      'correo' => 'required|email|max:100|unique:tenant.clientes,email|unique:tenant.users,email',
      'contraseña' => 'required|min:8',
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
      'correo.required' => 'El correo es obligatorio.',
      'correo.email' => 'El formato del correo es incorrecto.',
      'correo.max' => 'El correo no debe contener más de 100 caracteres.',
      'correo.unique' => 'El correo ingresado ya está registrado.',
      'contraseña.required' => 'La contraseña es obligatoria.',
      'contraseña.min' => 'La contraseña no puede ser menor a 8 dígitos.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect('/register')
        ->withErrors($validator)
        ->withInput();
    } else {
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
}
