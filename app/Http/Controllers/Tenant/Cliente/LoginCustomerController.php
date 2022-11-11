<?php

namespace App\Http\Controllers\Tenant\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
   * Válida que el correo y la contraseña se hayan ingresado
   * y tengan un formato correcto.
   * Si hay errores, retorna a la vista de login y muestra mensajes de error
   * Si no hay errores, junto al guard de 'cliente' se validan las credenciales para
   * autenticarlo si es que el cliente se encuentra registrado en la base de datos
   * Si no se encuentra registrado, muestra el mensaje en la vista de login
   */
  public function customerLogin(Request $request)
  {

    $rules = [
      'email' => 'required|email',
      'password' => 'required|min:8|max:50',
    ];

    $customMessages = [
      'email.required' => 'El correo es obligatorio.',
      'email.email' => 'El formato del correo es incorrecto.',
      'password.required' => 'La contraseña es obligatoria.',
      'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
      'password.max' => 'La contraseña no debe contener más de 50 caracteres.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect('/login')
        ->withErrors($validator)
        ->withInput();
    } else {
      if (Auth::guard('cliente')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
        return redirect()->intended('/cliente');
      }
      return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Estas credenciales no coinciden con nuestros registros.']);
    }
  }
}
