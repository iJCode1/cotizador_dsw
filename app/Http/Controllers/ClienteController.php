<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
  protected $user;
  public function __construct()
  {
    // $this->middleware('guest');
    $this->middleware('cliente');
    $this->middleware(function ($request, $next) {

      $this->user = Auth::guard('cliente')->user();

      return $next($request);
  });
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
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

    return redirect()->route('login')
      ->with('cliente', 'ok');
  }

  public function index(){
    // dd($this->user->rol->nombre_rol);
    // dd($this->user->rol->nombre_rol);
    // dd("Hola");
  }
}
