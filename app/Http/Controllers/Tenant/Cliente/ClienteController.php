<?php

namespace App\Http\Controllers\Tenant\Cliente;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{

  protected $user;

  public function __construct()
  {
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
   * Función showCliente()
   * retorna la vista de cliente
   */
  public function showCliente()
  {
    return view('/cliente');
  }

  /**
   * Función index()
   */
  public function index()
  {
    // dd($this->user->rol->nombre_rol);
    // dd($this->user->rol->nombre_rol);
    dd("Index Cliente");
  }
}
