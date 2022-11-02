<?php

namespace App\Http\Controllers\Tenant\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Http\Requests\CotizacionRequest;
use App\Models\Tenant\Cliente;
use App\Models\Tenant\Cotizacion;
use App\Models\Tenant\Detalle_Cotizacion;
use App\Models\Tenant\Estatus_Cotizacion;
use App\Models\Tenant\Producto_Servicio;
use App\Models\Tenant\Tipo_Producto_Servicio;
use App\Models\Tenant\Unidad_De_Medida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CotizacionesController extends Controller
{
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('cotizaciones');
  }
  public function index()
  {
    // dd("Hola");
    $cotizaciones = Cotizacion::all();
    return view('system.cotizaciones.index', [
      'cotizaciones' => $cotizaciones,
    ]);
  }

  public function showCotizacionForm()
  {
    $estatus = Estatus_Cotizacion::all();
    $tipos = Tipo_Producto_Servicio::all();

    return view('system.cotizaciones.cotizacion', [
      "estatus" => $estatus,
      "tipos" => $tipos,
    ]);
  }

  public function buscarCliente(Request $request)
  {
    $term = $request->get('term');
    $buscarCliente = Cliente::where('email', 'like', "%$term%")->get();
    return response()->json($buscarCliente);
  }

  public function seleccionarCliente(Request $request)
  {
    $cliente = Cliente::where('email', $request->cliente)->first();
    return response()->json($cliente);
  }

  public function buscarServicio(Request $request)
  {
    $term = $request->get('term');
    $buscarServicio = Producto_Servicio::where('nombre', 'like', "%$term%")->get();
    return response()->json($buscarServicio);
  }

  public function seleccionarServicio(Request $request)
  {
    $servicio = Producto_Servicio::where('nombre', $request->servicio)->first();
    return response()->json($servicio);
  }

  public function registrarCliente(Request $request)
  {
    // echo($request);
    // $nombre = $request->get('nombre');
    // echo($nombre);
    // $request->validate([
    //   'nombre' => 'required|max:45',
      // 'apep' => 'required|max:45',
      // 'apm' => 'required|max:45',
      // 'direccion' => 'required|max:255',
      // 'telefono' => 'required|min:10|max:10',
      // 'correo' => 'required|email|unique:tenant.clientes,email',
      // 'contraseña' => 'required|digits_between:8,45',
      // 'confirmar_contraseña' => 'required|digits_between:8,45',
    // ]);

    $rules = [
      'nombre' => 'required',
      'apep' => 'required',
      'apm' => 'required',
      'direccion' => 'required',
      'telefono' => 'required',
      'correo' => 'required|email|unique:tenant.clientes,email',
      'contraseña' => 'required',
      'confirmar_contraseña' => 'required',
    ];

    $customMessages = [
      'nombre.required' => 'El nombre del cliente es obligatorio.',
      'apep.required' => 'El apellido paterno es obligatorio.',
      'apm.required' => 'El apellido materno es obligatorio.',
      'direccion.required' => 'La dirección del cliente es obligatorio.',
      'telefono.required' => 'El telefono del cliente es obligatorio.',
      'correo.required' => 'El correo del cliente es obligatoro.',
      'correo.unique' => 'El correo ingresado ya está registrado',
      'contraseña.required' => 'La contraseña del cliente es obligatorio.',
      'confirmar_contraseña.required' => 'Confirmar la contraseña es obligatorio.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    
    if ($validator->passes()) {
      $contraseñaEncriptada = Hash::make($request->get('contraseña'));
      $cliente = [
        'nombre' => $request->get('nombre'),
        'apellido_p' => $request->get('apep'),
        'apellido_m' => $request->get('apm'),
        'direccion' => $request->get('direccion'),
        'telefono' => $request->get('telefono'),
        'email' => $request->get('correo'),
        'password' => $contraseñaEncriptada,
        'rol_id' => 3,
      ];
  
      Cliente::create($cliente);
      return response()->json([
        'type' => 'validate',
        'errors' => false
      ]);
    }else{
      return response()->json([
        'type' => 'validate',
        'errors' => $validator->errors()
      ]);
    
    }

    
    // $term = $request->get('term');
    // $buscarCliente = Cliente::where('email', 'like', "%$term%")->get();
    // return response()->json($buscarCliente);
  }

  public function createCotizacion(Request $request)
  {
    // dd($request['servicio_uuid']);

    // if($request['servicio_uuid'] === null){
    //   // dd("Nullo");
    //   return redirect()->back()->with('success', 'your message,here');   
    // }else{
    //   dd("No es nullo");
    // }

    // dd($request);
    $rules = [
      'cliente' => 'required',
      'nombreCliente' => 'required',
      'correoCliente' => 'required',
      'nombre_cotizacion' => 'required',
      'descripcion' => 'required',
      'fecha_creacion' => 'required',
      'vigencia' => 'required',
      'estatus_cotizacion_id' => 'required',
      'servicio_uuid' => 'required',
    ];

    $customMessages = [
      'cliente.required' => 'Se debe buscar un cliente.',
      'nombreCliente.required' => 'El nombre del cliente es obligatorio.',
      'correoCliente.required' => 'El correo del cliente es obligatorio.',
      'nombre_cotizacion.required' => 'El folio de la cotización es obligatorio.',
      'descripcion.required' => 'La descripción de la cotización es obligatorio.',
      'fecha_creacion.required' => 'La fecha de creación es obligatoro.',
      'vigencia.required' => 'La vigencia de la cotización es obligatorio.',
      'estatus_cotizacion_id.required' => 'El estatus de la cotización es obligatorio.',
      'servicio_uuid.required' => 'No se ha seleccionado nada para cotizar.',
      // 'servicio_id' => 'required',
    ];
    

    $validatedData = $request->validate($rules, $customMessages);
    // dd($validatedData);

    // $request->validate([
      
    //   // 'servicio' => 'required',
    //   // 'nombre_serv' => 'required',
    //   // 'descripcion' => 'required',
    //   // 'tipo' => 'required',
    //   // 'precio' => 'required',
    //   // 'cantidad' => 'required',
      // 'servicio_id' => 'required',
      // 'servicio_uuid' => 'required',
      // 'nombre' => 'required',
      // 'precio_inicial' => 'required',
      // 'descuento_aplicado' => 'required',
      // 'numero_servicios' => 'required',
      // 'precio_bruto' => 'required',
      // 'precio_iva' => 'required',
      // 'subtotal' => 'required',
    // ]);

    // $uuid = $request['servicio_uuid'];
    // $nombre = $request['nombre'];
    // $precioIni = $request['precio_inicial'];
    // $descuento = $request['descuento_aplicado'];
    // $numero = $request['numero_servicios'];
    // $precioB = $request['precio_bruto'];
    // $precioI = $request['precio_iva'];
    // $subtotal = $request['subtotal'];

    // if($uuid === null || $nombre === null || $precioIni === null || $descuento === null || $numero === null || $precioB === null || $precioI === null || $subtotal === null){
    //   return redirect()->back()->with('sinProductos', 'yes');   
    // }


    // dd("coti");
    // dd($request->all() + ['usuario_id' => Auth::user()->user_id] + ['cliente_id' => 1]);
    // dd(Auth::user()->user_id);
    // dd(Cotizacion);
    // dd($request->estatus_cotizacion_id);
    // $cot = [
    //   "nombre_cotizacion" => $request->nombre_cotizacion,
    //   "descripcion" => $request->descripcion,
    //   "fecha_creacion" => $request->fecha_creacion,
    //   "vigencia" => $request->vigencia,
    //   "usuario_id" => Auth::user()->user_id,
    //   "estatus_cotizacion_id" => $request->estatus_cotizacion_id,
    //   "cliente_id" => Auth::user()->user_id
    // ];
    // Cotizacion::create($cot);

    // // return redirect()->route('tenant.cotizaciones');
    
    return DB::transaction(function () use ($request) {

      // $cotizacion = [
      //   'nombre_cotizacion' => $request['nombre_cotizacion'],
      //   'descripcion' => $request['descripcion'],
      //   'fecha_creacion' => $request['fecha_creacion'],
      //   'vigencia' => $request['vigencia'],
      //   'usuario_id' =>  Auth::user()->user_id,
      //   'estatus_cotizacion_id' => $request['estatus_cotizacion_id'],
      //   'cliente_id' => $request['cliente_id'],
      // ];
  
      // dd($cotizacion);
      // Cotizacion::create($cotizacion);

      $cotizacion = Cotizacion::create($request->all() + ['usuario_id' => Auth::user()->user_id]);
      // dd("Cotizdo");
      foreach ($request->servicio_id as $index => $servicio_id) {
        $cotizacion->cotizaciones()->create([
          'cantidad' => $request->numero_servicios[$index],
          'precio_inicial' => $request->precio_inicial[$index],
          'precio_bruto' => $request->precio_bruto[$index],
          'iva' => $request->precio_iva[$index],
          'subtotal' => $request->subtotal[$index],
          'descuento' => $request->descuento_aplicado[$index],
          'cotizacion_id' => $cotizacion->cotizacion_id,
          'producto_servicio_id' => $servicio_id,
        ]);
      }
      //   ->route('cotizaciones.index')->withSuccess("La cotizacion $cotizacion->nombre_proyecto se creo exitosamente");
      return redirect()
        ->route('tenant.cotizaciones')
        ->with('crear', 'ok');
    });
  }

  public function showCotizacionEditForm($cotizacion_id)
  {
    // dd($cotizacion_id);

    $cotizacion = Cotizacion::find($cotizacion_id);
    $estatus = Estatus_Cotizacion::all();
    // $servicios = ;
    // $servicios = DB::select("SELECT dco.detalle_cotizacion_id, dco.cantidad, dco.precio_bruto, dco.iva, dco.subtotal, serv.nombre, serv.descripcion
    // FROM detalle_cotizaciones AS dco
    // INNER JOIN productos_servicios AS serv
    // ON dco.producto_servicio_id = serv.producto_servicio_id
    // WHERE cotizacion_id = $cotizacion_id");

    $servicios = Detalle_Cotizacion::select('detalle_cotizaciones.detalle_cotizacion_id', 'detalle_cotizaciones.cantidad', 'detalle_cotizaciones.descuento', 'detalle_cotizaciones.precio_inicial', 'detalle_cotizaciones.precio_bruto', 'detalle_cotizaciones.iva', 'detalle_cotizaciones.subtotal', 'productos_servicios.nombre', 'productos_servicios.descripcion')
      ->join('productos_servicios', 'detalle_cotizaciones.producto_servicio_id', '=', 'productos_servicios.producto_servicio_id')
      ->where("detalle_cotizaciones.cotizacion_id", "=", $cotizacion_id)
      ->get();

    // dd("heyy");
    // dd($servicios);

    return view('system.cotizaciones.edit', [
      'cotizacion' => $cotizacion,
      'estatus' => $estatus,
      'servicios' => $servicios,
    ]);
  }

  public function editCotizacion(Request $request, $cotizacion_id)
  {
    $request->validate([
      'nombre_cotizacion' => 'required|min:1|max:100',
      'descripcion' => 'required|min:1|max:255',
      'estatus_cotizacion_id' => 'required',
    ]);


    $cotizacion = Cotizacion::find($cotizacion_id);
    // dd($request);

    $cotizacion->nombre_cotizacion = $request->nombre_cotizacion;
    $cotizacion->descripcion = $request->descripcion;
    $cotizacion->estatus_cotizacion_id = $request->estatus_cotizacion_id;
    $cotizacion->update();

    // dd($request);
    return redirect()
      ->route('tenant.cotizaciones')
      ->with('editar', 'ok');
  }
}
