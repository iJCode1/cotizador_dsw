<?php

namespace App\Http\Controllers\Tenant\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Http\Requests\CotizacionRequest;
use App\Models\Tenant\Cotizacion;
use App\Models\Tenant\Estatus_Cotizacion;
use App\Models\Tenant\Producto_Servicio;
use App\Models\Tenant\Tipo_Producto_Servicio;
use App\Models\Tenant\Unidad_De_Medida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
    // $this->middleware('guest');
    // $this->middleware('guest:cliente');
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

  public function createCotizacion(Request $request)
  {
    // $request->validate([
    //   // 'nombre_cot' => 'required',
    //   // 'descripcion_cot' => 'required',
    //   // 'fecha_creacion' => 'required',
    //   // 'vigencia' => 'required',
    //   // 'estatus' => 'required',
    //   // 'servicio' => 'required',
    //   // 'nombre_serv' => 'required',
    //   // 'descripcion' => 'required',
    //   // 'tipo' => 'required',
    //   // 'precio' => 'required',
    //   // 'cantidad' => 'required',
    //   'servicio_id' => 'required',
    //   'servicio_uuid' => 'required',¿
    //   'nombre' => 'required',
    //   'precio_inicial' => 'required',
    //   'numero_servicios' => 'required',
    //   'precio_bruto' => 'required',
    //   'precio_iva' => 'required',
    //   'subtotal' => 'required',
    // ]);

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
    // // dd("Hey");
    return DB::transaction(function () use ($request) {
      $cotizacion = Cotizacion::create($request->all() + ['usuario_id' => Auth::user()->user_id] + ['cliente_id' => 1]);
      // dd($cotizacion);
      // echo "YES";
      // dd($request->all());
      foreach ($request->servicio_id as $index => $servicio_id) {
        $cotizacion->cotizaciones()->create([
          'cantidad' => $request->numero_servicios[$index],
          // 'fecha_estimadaentrega' => Carbon::now(),
          'precio_bruto' => $request->precio_bruto[$index],
          'iva' => $request->precio_iva[$index],
          'subtotal' => $request->subtotal[$index],
          'descuento' => 0,
          'cotizacion_id' => $cotizacion->cotizacion_id,
          'producto_servicio_id' => $servicio_id,
        ]);
      }
      // dd("Hey");

      // return redirect()
      //   ->route('cotizaciones.index')->withSuccess("La cotizacion $cotizacion->nombre_proyecto se creo exitosamente");
      return redirect()
        ->route('tenant.cotizaciones');
    });
  }
}
