<?php

namespace App\Http\Controllers\Tenant\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cotizacion;
use App\Models\Tenant\Estatus_Cotizacion;
use App\Models\Tenant\Producto_Servicio;
use App\Models\Tenant\Tipo_Producto_Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionesController extends Controller
{

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
    dd($request);
  }
}
