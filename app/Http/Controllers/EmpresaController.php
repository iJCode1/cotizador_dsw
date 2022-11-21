<?php

namespace App\Http\Controllers;

if (!isset($_SESSION)) {
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// MultiTenancy
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;

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
   * Enlista las empresas que ha dado de alta el administrador general
   */
  public function index()
  {
    $id = Auth::user()->id ?? 0; // ID del usuario logueado
    // Consulta entre 2 tablas - Users y Roles
    $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();

    $empresas = Empresa::withTrashed()->get();
    $municipios = Municipio::all();
    $estados = Estado::all();
    $hostnames = Hostname::all();
    $websites = Website::withTrashed()->get();
    $users = User::all();

    return view('Empresa.index', [
      'user' => $user,
      'empresas' => $empresas,
      'municipios' => $municipios,
      'estados' => $estados,
      'hostnames' => $hostnames,
      'websites' => $websites,
      'users' => $users
    ]);
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
   * Hace la validación de los datos ingresados
   * Si encuentra un error, regresa al formulario y muestra los errores
   * Si los datos son correctos, invoca la función registered
   */
  public function registrarEmpresa(Request $request)
  {

    $rules = [
      'fqdn' => 'required|unique:Empresas',
      'address' => 'required|string|min:1',
      'postal' => 'required|digits_between:5,5',
      'estado' => 'required',
      'municipio_id' => 'required',
      'rfc' => 'required|between:13,13',
      'nameContact' => 'required|string',
      'apep' => 'required|string',
      'apem' => 'required|string',
      'phone' => 'required|numeric|digits_between:10,10',
      'email' => 'required|email|unique:Empresas,correo_electronico',
      'password' => 'required|min:8',
    ];

    $customMessages = [
      'fqdn.required' => 'El nombre de la empresa es obligatorio.',
      'fqdn.unique' => 'El nombre de la empresa ya ha sido utilizado antes.',
      'address.required' => 'La dirección es obligatoria.',
      'address.string' => 'Se han introducido valores inválidos en la dirección.',
      'address.min' => 'La dirección debe contener al menos 1 carácter.',
      'postal.required' => 'El código postal es obligatorio.',
      'postal.digits_between' => 'El código postal debe ser de 5 dígitos.',
      'estado.required' => 'Se debe seleccionar el estado.',
      'municipio_id.required' => 'Se debe seleccionar el municipio.',
      'number.required' => 'El número es obligatorio.',
      'number.numeric' => 'El número solo acepta valores numéricos.',
      'number.digits_between' => 'El número debe estar entre 1 y 5 dígitos.',
      'rfc.required' => 'El RFC es obligatorio.',
      'rfc.between' => 'El RFC debe ser de 13 caracteres.',
      'nameContact.required' => 'El nombre es obligatorio.',
      'nameContact.string' => 'El nombre solo debe contener letras y espacios.',
      'apep.required' => 'El apellido paterno es obligatorio.',
      'apep.string' => 'El apellido paterno solo debe contener letras y espacios.',
      'apem.required' => 'El apellido materno es obligatorio.',
      'apem.string' => 'El apellido materno solo debe contener letras y espacios.',
      'phone.required' => 'El teléfono es obligatorio.',
      'phone.numeric' => 'El teléfono solo acepta valores numéricos.',
      'phone.digits_between' => 'El teléfono debe ser de 10 dígitos.',
      'email.required' => 'El correo electrónico es obligatorio.',
      'email.email' => 'El correo electrónico tiene un formato incorrecto.',
      'email.unique' => 'El correo electrónico ya ha sido utilizado antes.',
      'password.required' => 'La contraseña es obligatoria.',
      'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/empresa")
        ->withInput()
        ->withErrors($validator);
    } else {
      // Se prepara la imágen para ser almacenada dentro de la carpeta 'images > logotipos/'
      $file = $request->file('imagen'); // Se obtiene la imagen
      $img2 = "no-image.webp";
      if ($file != "") { // Si la imagen es diferente de vacio
        $imgDestination = 'images/logotipos/';
        $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
        $img2 = time() . '-' . $img; // Se concatena el nombre de la imagen
        $request->file('imagen')->move($imgDestination, $img2);
      }

      $contraseña = Hash::make($request->password);
      $_SESSION['name_contact'] = $request->nameContact;
      $_SESSION['lastname1'] = $request->apep;
      $_SESSION['lastname2'] = $request->apem;
      $_SESSION['email'] = $request->email;
      $_SESSION['password'] = $contraseña;
      $_SESSION['address'] = $request->address;
      $_SESSION['codigo_postal'] = $request->postal;
      $_SESSION['rfc'] = $request->rfc;
      $_SESSION['imagen'] = $img2;
      $_SESSION['fqdn'] = $request->fqdn;
      $_SESSION['phone'] = $request->phone;
      $this->registered($request, $img2);

      return redirect()->route('empresas')
        ->with('crear', 'ok');
    }
  }

  /**
   * La empresa ya fue validada
   * Se hace el alta de un Website y un Hostname
   *
   * @param  \Illuminate\Http\Request $request
   * @return mixed $user
   * @return mixed
   */

  /**
   * Función registered()
   * Esta función hace el registro de un website y un hostname
   * para la empresa que se está registrando
   * finalmente invoca a la función crearEmpresa
   */
  protected function registered($request, $img)
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

    $this->crearEmpresa($request, $hostname, $img);
  }

  /**
   * Función crearEmpresa()
   * Se obtienen los datos ingresados en el formulario
   * Hace el alta de la nueva empresa en la BD
   */
  public function crearEmpresa($request, $hostname, $img)
  {
    $empresa = [
      'direccion' => $request->address,
      'codigo_postal' => $request->postal,
      'rfc' => $request->rfc,
      'imagen' => $img, 
      'nombre_contacto' => $request->nameContact,
      'apellido_p' => $request->apep,
      'apellido_m' => $request->apem,
      'telefono' => $request->phone,
      'correo_electronico' => $request->email,
      'contraseña' => Hash::make($request->password),
      'fqdn' => $request->fqdn,
      'usuario_id' => Auth::user()->id,
      'hostname_id' => $hostname->id,
      'municipio_id' => $request->municipio_id
    ];

    Empresa::create($empresa);
  }

  /**
   * Función showEmpresa()
   * Obtiene la información de la empresa de la que se quiere ver su información
   */
  public function showEmpresa($empresa)
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
    
    return view('Empresa.info', [
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
   * Recibe los datos editados de la empresa y hace la validación
   * Si los datos son correctos, actualiza la información de la empresa
   * Si no, regresa a la vista de edición y muestra los errores
   */
  public function actualizarEmpresa(Request $request, $empresaID)
  {

    $rules = [
      'address' => 'required|string|min:1',
      'postal' => 'required|digits_between:5,5',
      'number' => 'required|numeric|digits_between:1,5',
      'estado' => 'required',
      'municipio_id' => 'required',
      'rfc' => 'required|between:13,13',
      'nameContact' => 'required|string',
      'apep' => 'required|string',
      'apem' => 'required|string',
      'phone' => 'required|numeric|digits_between:10,10',
    ];

    $customMessages = [
      'address.required' => 'La dirección es obligatoria.',
      'address.string' => 'Se han introducido valores inválidos en la dirección.',
      'address.min' => 'La dirección debe contener al menos 1 carácter.',
      'postal.required' => 'El código postal es obligatorio.',
      'postal.digits_between' => 'El código postal debe ser de 5 dígitos.',
      'estado.required' => 'Se debe seleccionar el estado.',
      'municipio_id.required' => 'Se debe seleccionar el municipio.',
      'number.required' => 'El número es obligatorio.',
      'number.numeric' => 'El número solo acepta valores numéricos.',
      'number.digits_between' => 'El número debe estar entre 1 y 5 dígitos.',
      'rfc.required' => 'El RFC es obligatorio.',
      'rfc.between' => 'El RFC debe ser de 13 caracteres.',
      'nameContact.required' => 'El nombre es obligatorio.',
      'nameContact.string' => 'El nombre solo debe contener letras y espacios.',
      'apep.required' => 'El apellido paterno es obligatorio.',
      'apep.string' => 'El apellido paterno solo debe contener letras y espacios.',
      'apem.required' => 'El apellido materno es obligatorio.',
      'apem.string' => 'El apellido materno solo debe contener letras y espacios.',
      'phone.required' => 'El teléfono es obligatorio.',
      'phone.numeric' => 'El teléfono solo acepta valores numéricos.',
      'phone.digits_between' => 'El teléfono debe ser de 10 dígitos.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/empresa/$empresaID/editar")
        ->withInput()
        ->withErrors($validator);
    } else {
      $empresa = Empresa::find($empresaID);
      $empresa->direccion = $request->address;
      $empresa->codigo_postal = $request->postal;
      $empresa->numero = $request->number;
      $empresa->rfc = $request->rfc;
      $empresa->nombre_contacto = $request->nameContact;
      $empresa->apellido_p = $request->apep;
      $empresa->apellido_m = $request->apem;
      $empresa->telefono = $request->phone;
      $empresa->municipio_id = $request->municipio_id;
      $empresa->update();

      return redirect()->route("empresas")
        ->with('editar', 'ok');
    }
  }

  /**
   * Función desactivarEmpresa()
   * obtiene el id del website que se quiere dar de baja (baja lógica)
   * lo busca y da de baja el website
   * hace el redireccionamiento a la ruta 'empresas'
   */
  public function desactivarEmpresa($id)
  {
    date_default_timezone_set('America/Mexico_City');

    $website_id = Empresa::find($id)->hostname->website->id;
    Website::withTrashed()
      ->find($website_id)
      ->delete();

    return redirect()->route('empresas')
      ->with('eliminar', 'ok');
  }

  /**
   * Función activateEmpresa()
   * obtiene el id del website que se quiere volver a activar (quitar baja lógica)
   * lo busca y lo activa nuevamente
   * hace el redireccionamiento a la ruta 'empresas'
   */
  public function activateEmpresa($website_id)
  {
    Website::withTrashed()
      ->find($website_id)
      ->restore();

    return redirect()->route('empresas')
      ->with('activar', 'ok');
  }
}
