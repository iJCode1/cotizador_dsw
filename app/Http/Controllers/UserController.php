<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{


  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('adminGeneral');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Función index()
   * Enlista las empresas que ha dado de alta el administrador general
   */
  public function AuthRouteAPI(Request $request)
  {
    return $request->user();
  }
}
