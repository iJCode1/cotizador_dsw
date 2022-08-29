<?php

namespace App\Http\Controllers;

if(!isset($_SESSION)) {
  session_start();
} else {
  session_destroy();
  session_start();
}

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Empresa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// MultiTenancy
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;


use Hyn\Tenancy\Events\Hostnames as Events;
use Hyn\Tenancy\Traits\DispatchesEvents;
use Hyn\Tenancy\Validators\HostnameValidator;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Database\Eloquent\Builder;

use App\User;


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
   * Enlista las empresas que ha dado de alta el administrador
   */
  public function index()
  {
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();

    $empresas = Empresa::all();
    $municipios = Municipio::all();
    $estados = Estado::all();
    $hostname = Hostname::all();
    $users = User::all();

    return view('Empresa.index', ['user' => $user, 'empresas' => $empresas, 'municipios' => $municipios, 'estados' => $estados, 'hostnames' => $hostname, 'users' => $users]);
  }

  /**
   * Función altaEmpresa()
   * Hace la consulta a las tablas de Estados y Municipios
   * Retorna las consultas junto a la vista altaEmpresa
   * La vista muestra formulario para dar de alta una empresa
   */
  public function altaEmpresa()
  {
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();

    $estados = Estado::select('estado_id', 'nombre')->get();
    $municipios = Municipio::select('municipio_id', 'nombre', 'estado_id')
      ->orderBy('estado_id')
      ->orderBy('nombre', 'Asc')
      ->get();

    return view('Empresa.altaEmpresa')
      ->with('estados', $estados)
      ->with('municipios', $municipios)
      ->with('user', $user);
  }

  /**
   * Función registrarEmpresa()
   */
  public function registrarEmpresa(Request $request)
  {
    // Las validaciones se hacen de izquierda a derecha
    // dd($request);
    $request->validate([
      'fqdn' => 'required|unique:Empresas',
      'address' => 'required',
      'postal' => 'required|min:5|max:5',
      'estado' => 'required',
      'municipio_id' => 'required',
      'number' => 'required|digits_between:1,5',
      'rfc' => 'required|min:13|max:13',
      'nameContact' => 'required','regex: /^[A-Z][A-Z,a-z,\s, á, é, í, ó, ú, ü]+$/',
      'phone' => 'required|min:10|max:10',
      'email' => 'required|email|unique:Empresas,correo_electronico',
      'password' => 'required|digits_between:8,45',
      'password_confirmation' => 'required',
    ]);
    // $this->validate($request, [
            // 'fqdn' => ['required', 'string', 'max:20', Rule::unique('hostnames')->where(function ($query) use ($fqdn) {
            //   return $query->where('fqdn', $fqdn);
            // })],
    //   'address' => ['required', 'string',],
    //   'postal' => ['required', 'string', 'regex: /^[0-9]{5}$/'],
    //   'number' => ['required', 'string', 'regex: /^[0-9]*$/', 'max:10'],
            // 'estado' => ['required'],
    //   'municipio' => ['required'],
            // 'rfc' => ['required', 'string', 'regex: /^[0-9][A-Z,a-z]{13}$/'],
    //   'nameContact' => ['required', 'string', 'max:50'],
    //   'phone' => ['required', 'string', 'regex: /^[0-9]{10}$/'],
    //   'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
    //   'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
    // ]);
    $contraseña = Hash::make($request->password);
    $_SESSION['name'] = $request->fqdn;
    $_SESSION['email'] = $request->email;
    $_SESSION['password'] = $contraseña;
    $this->registered($request);

    return redirect()->route('empresas');
  }

  /**
   * La empresa ya fue validada
   * Se hace la alta de un Website y un Hostname
   *
   * @param  \Illuminate\Http\Request $request
   * @return mixed $user
   * @return mixed
   */

   /**
    * Función registered()
    * Esta función hace el registro de un website y un hostname
    */
  protected function registered($request)
  {
    // Se concatena: fqdn.APP_DOMAIN
    $fqdn1 = sprintf('%s.%s', $request->fqdn, env('APP_DOMAIN'));
    $website = new Website;
    $website->uuid = $fqdn1;
    app(WebsiteRepository::class)->create($website);

    $hostname = new Hostname();
    $hostname->fqdn = $fqdn1;
    $hostname = app(HostnameRepository::class)->create($hostname);


    app(HostnameRepository::class)->attach($hostname, $website);

    $this->crearEmpresa($request, $hostname);
  }

  /**
   * Función crearEmpresa()
   * Se obtienen los datos ingresados en el formulario y se hace la alta de una nueva empresa
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
      'fqdn' => $request->fqdn,
      'usuario_id' => Auth::user()->id,
      'hostname_id' => $hostname->id,
      'municipio_id' => $request->municipio_id
    ];

    Empresa::create($empresa);
    // Session::flash('mensaje', "Se ha registrado la empresa $request->fqdn correctamente!");
    // Session::flash('tipoDeMensaje', "satisfactorio");
  }

  /**
   * Función editarEmpresa()
   * Obtiene la información de la empresa que se quiere editar
   * Obtiene los estados y municipios y se lo manda a la vista de Empresa.editar
   */
  public function editarEmpresa($empresa)
  {
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();

    $empresaFind = Empresa::find($empresa);

    // Consulta entre 2 tablas - Empresas y Hostames
    $fqdn = Hostname::find($empresaFind->hostname_id);

    $municipioId = $empresaFind->municipio_id;
    $municipios = Municipio::select('municipio_id', 'nombre', 'estado_id')
      ->orderBy('estado_id')
      ->orderBy('nombre', 'Asc')
      ->get();
    $municipioEmpresa = Municipio::find($municipioId);
    $municipiosEmpresa = Municipio::where('estado_id', '=', $municipioEmpresa->estado_id)->get();

    $estadoId = Estado::find($municipioEmpresa->estado_id);
    $estados = Estado::all();
    $estadoEmpresa = $estadoId->nombre;

    return view('Empresa.editar', [
      'empresa' => $empresaFind,
      'user' => $user,
      'fqdn' => $fqdn->fqdn,
      'municipios' => $municipios,
      'estados' => $estados,
      'municipioEmpresa' => $municipioEmpresa,
      'municipiosEmpresa' => $municipiosEmpresa,
      'estadoEmpresa' => $estadoEmpresa,
    ]);
  }

  /**
   * Función actualizarEmpresa()
   * Recibe los datos editados de la empresa y los actualiza en el registro
   */
  public function actualizarEmpresa(Request $request, $empresaID)
  {
    $request->validate([
      'address' => 'required',
      'postal' => 'required|min:5|max:5',
      'number' => 'required|digits_between:1,5',
      'rfc' => 'required|min:13|max:13',
      'nameContact' => 'required','regex: /^[A-Z][A-Z,a-z,\s, á, é, í, ó, ú, ü]+$/',
      'phone' => 'required|min:10|max:10',
      'municipio_id' => 'required',
      'estado' => 'required',
    ]);

    $empresa = Empresa::find($empresaID);
    $empresa->direccion = $request->address;
    $empresa->codigo_postal = $request->postal;
    $empresa->numero = $request->number;
    $empresa->rfc = $request->rfc;
    $empresa->nombre_contacto = $request->nameContact;
    $empresa->telefono = $request->phone;
    $empresa->municipio_id = $request->municipio_id;
    $empresa->update();

    return redirect()->route("empresas");
  }

  /**
   * Función desactivarEmpresa()
   * Hace una baja lógica de la empresa seleccionada
   */
  public function desactivarEmpresa($id)
  {
    Empresa::find($id)
      ->delete();
    return redirect()->route('empresas');
  }
}
