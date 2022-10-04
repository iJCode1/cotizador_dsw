<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Rol;
use App\Models\Tenant\User as User2;
use App\Models\Website;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  protected $tenantName = null;
  protected $website_id = null;
  protected $website = null;

  public function __construct()
  {
    // $this->middleware('adminEmpresa');
    // $this->middleware('cliente');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      // $this->middleware('auth');
      // $this->middleware('cliente');
      $this->website_id = app(\Hyn\Tenancy\Environment::class)->hostname()->website_id;
      $this->website = Website::withTrashed()->find($this->website_id);
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }else{
      $this->middleware('auth');
    }
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    if (!$this->tenantName) {
      echo(Auth::user().'<br>');
      echo(Auth::user()->rol->nombre_rol);
      return view('home');
    } else {
      if (Auth::guard('cliente')->user()) {
        echo(Auth::guard('cliente')->user().'<br>');
        echo(Auth::guard('cliente')->user()->rol->nombre_rol);
      }else{
        echo(Auth::user().'<br>');
        echo(Auth::user()->rol->nombre_rol);
      }
      return view('home');
    }
  }
}
