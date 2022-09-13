<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest');
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
      'correo' => 'required|email|unique:tenant.clientes,correo_electronico',
      'contraseña' => 'required|digits_between:8,45',
      'confirmar_contraseña' => 'required|digits_between:8,45',
    ]);

    $cliente = [
      'nombre' => $request->nombre,
      'apellido_p' => $request->app,
      'apellido_m' => $request->apm,
      'direccion' => $request->direccion,
      'telefono' => $request->telefono,
      'correo_electronico' => $request->correo,
      'contraseña' => $request->contraseña,
      'rol_id' => 3,
    ];

    Cliente::create($cliente);

    return redirect()->route('login')
      ->with('cliente', 'ok');
  }
}
