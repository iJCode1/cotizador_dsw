<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Estados;
use App\Models\Municipios;
use App\Models\Empresas;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// MultiTenancy
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;

class EmpresaController extends Controller
{

  protected $tenantName = null;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $user = Auth::user();
    $this->middleware('auth');
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Función altaEmpresa()
   * Hace la consulta a las tablas de Estados y Municipios
   * Retorna las consultas junto a una vista
   */
  public function altaEmpresa()
  {
    $estados = Estados::select('estado_id', 'nombre')->get();
    $municipios = Municipios::select('municipio_id', 'nombre', 'estado_id')
      ->orderBy('estado_id')
      ->orderBy('nombre', 'Asc')
      ->get();
    return view('altaEmpresa')
      ->with('estados', $estados)
      ->with('municipios', $municipios);
  }

  /**
   * Función registrarEmpresa()
   */
  public function registrarEmpresa(Request $request)
  {
    // Las validaciones se hacen de izquierda a derecha
    // $this->validate($request, [
    //   // 'fqdn' => ['required', 'string', 'max:20', Rule::unique('hostnames')->where(function ($query) use ($fqdn) {
    //   //   return $query->where('fqdn', $fqdn);
    //   // })],
    //   'address' => ['required', 'string',],
    //   'postal' => ['required', 'string', 'regex: /^[0-9]{5}$/'],
    //   'number' => ['required', 'string', 'regex: /^[0-9]*$/', 'max:10'],
    //   // 'estado' => ['required'],
    //   'municipio' => ['required'],
    //   // 'rfc' => ['required', 'string', 'regex: /^[0-9][A-Z,a-z]{13}$/'],
    //   'nameContact' => ['required', 'string', 'max:50'],
    //   'phone' => ['required', 'string', 'regex: /^[0-9]{10}$/'],
    //   'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
    //   'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
    // ]);
    $this->registered($request);
  }


  /**
   * La empresa ya fue validada
   * Se hace la alta de un Website y un Hostname
   *
   * @param  \Illuminate\Http\Request $request
   * @return mixed $user
   * @return mixed
   */
  protected function registered($request)
  {
    // Se concatena: fqdn.APP_DOMAIN
    $fqdn = sprintf('%s.%s', $request->fqdn, env('APP_DOMAIN'));
    $website = new Website;
    $website->uuid = $fqdn;
    app(WebsiteRepository::class)->create($website);

    $hostname = new Hostname();
    $hostname->fqdn = $fqdn;
    $hostname = app(HostnameRepository::class)->create($hostname);

    app(HostnameRepository::class)->attach($hostname, $website);
    $this->crearEmpresa($request, $hostname);
  }

  /**
   * Se hace la alta de una nueva empresa
   */
  public function crearEmpresa($request, $hostname)
  {
    $empresa = [
      'direccion' => $request->address,
      'codigo_postal' => $request->postal,
      'numero' => $request->number,
      'rfc' => $request->rfc,
      'nombre_contacto' => $request->nameContact,
      'telefono' => $request->phone,
      'correo_electronico' => $request->email,
      'contraseña' => Hash::make($request->password),
      'hostname_id' => $hostname->id,
      'municipio_id' => $request->municipio_id
    ];

    Empresas::create($empresa);
    return redirect()->route('/empresa');

    // Session::flash('mensaje', "Se ha registrado la empresa $request->fqdn correctamente!");
    // Session::flash('tipoDeMensaje', "satisfactorio");
  }
}
