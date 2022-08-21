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


use Hyn\Tenancy\Events\Hostnames as Events;
use Hyn\Tenancy\Traits\DispatchesEvents;
use Hyn\Tenancy\Validators\HostnameValidator;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Database\Eloquent\Builder;

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
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

    public function altaempresa(){
      $estados = Estados::select('estado_id', 'nombre')->get();
      $municipios = Municipios::select('municipio_id', 'nombre', 'estado_id')
                    ->orderBy('estado_id')
                    ->orderBy('nombre', 'Asc')
                    ->get();
      return view('altaempresa')
             ->with('estados', $estados)
             ->with('municipios', $municipios);
    }

    public function registrarempresa(Request $request){
      $userID = Auth::user()->id; // ID del usuario autenticado
      // dd(Auth::user());

      // dd($request);
      // Se concatena: hostname.APP_DOMAIN
      // $fqdn = sprintf('%s.%s', $request['fqdn'], env('APP_DOMAIN'));

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
    
      $uuid =  Str::random(10);
      echo($uuid);
      
      $empresa = [
        'fqdn' => $request->fqdn,
        'uuid' => $uuid, // No pasarse de 32
        'direccion' => $request->address,
        'codigo_postal' => $request->postal,
        'numero' => $request->number,
        'rfc' => $request->rfc,
        'nombre_contacto' => $request->nameContact,
        'telefono' => $request->phone,
        'correo_electronico' => $request->email,
        'contraseña' => Hash::make($request->password),
        'municipio_id' => $request->municipio_id,
        'usuario_id' => $userID,
      ];
      echo($empresa['uuid']);
     
      // dd($empresa['municipio_id']);
      $this->registered($request->fqdn, $uuid, $empresa);

      Session::flash('mensaje', "Se ha registrado la empresa $request->fqdn correctamente!");
      Session::flash('tipoDeMensaje', "satisfactorio");
    }


  /**
   * La empresa ya fue registrada
   *
   * @param  \Illuminate\Http\Request $request
   * @return mixed $user
   * @return mixed
   */
  protected function registered($fqdn, $uuid, $empresa)
  {
    if (!$this->tenantName) {

      $website = new Website;
      $website->uuid = $uuid;
      app(WebsiteRepository::class)->create($website);

      $websiteID = $website->id;

      $fqdn1 = sprintf('%s.%s', $fqdn, env('APP_DOMAIN'));
      $empresa1 = new Empresas();
      $empresa1->fqdn = $fqdn1;
      // $empresa1->uuid = $uuid;
      $empresa1->direccion = $empresa['direccion'];
      $empresa1->codigo_postal = $empresa['codigo_postal'];
      $empresa1->numero = $empresa['numero'];
      $empresa1->rfc = $empresa['rfc'];
      $empresa1->nombre_contacto = $empresa['nombre_contacto'];
      $empresa1->telefono = $empresa['telefono'];
      $empresa1->correo_electronico = $empresa['correo_electronico'];
      $empresa1->contraseña = $empresa['contraseña'];
      $empresa1->municipio_id = $empresa['municipio_id'];
      $empresa1->usuario_id = $empresa['usuario_id'];
      $empresa1->website_id = $websiteID;
      $empresa1->save();
    }
  }
}
