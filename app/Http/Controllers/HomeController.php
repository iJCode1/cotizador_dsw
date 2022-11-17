<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Estado;
use App\Models\Hostname;
use App\Models\Municipio;
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
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $this->website_id = app(\Hyn\Tenancy\Environment::class)->hostname()->website_id;
      $this->website = Website::withTrashed()->find($this->website_id);
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    } else {
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
      $empresas = Empresa::withTrashed()->get();
      $websites = Website::withTrashed()->get();

      return view('Empresa.index', [
        'empresas' => $empresas,
        'websites' => $websites,
      ]);
    } else {
      if (Auth::guard('cliente')->user()) {
        return redirect()->route('tenant.cotizaciones');
      } else {
        return redirect()->route('tenant.showServicios');
      }
    }
  }
}
