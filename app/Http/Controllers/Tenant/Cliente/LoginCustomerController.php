<?php

namespace App\Http\Controllers\Tenant\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCustomerController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
    $this->middleware('guest:cliente')->except('logout');
  }

  /**
   * Función showCustomerLoginForm()
   * Retorna la vista de auth.login
   * para que el cliente pueda ingresar a su cuenta
   */
  public function showCustomerLoginForm()
  {
    return view('auth.login', ['url' => 'cliente']);
  }

  /**
   * Función customerLogin()
   * Valida que el correo y la contraseña se hayan ingresado
   * y tengan un formato correcto.
   * Junto al guard de 'cliente', se validan las credenciales para
   * autenticarlo si es que se encuentra el cliente en la base de datos
   */
  public function customerLogin(Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);

    if (Auth::guard('cliente')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

      return redirect()->intended('/cliente');
    }
    return back()->withInput($request->only('email', 'remember'));
  }
}
