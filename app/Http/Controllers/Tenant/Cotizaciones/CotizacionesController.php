<?php

namespace App\Http\Controllers\Tenant\Cotizaciones;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Cotizacion;
use App\Models\Tenant\Estatus_Cotizacion;
use Illuminate\Http\Request;

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

    return view('system.cotizaciones.cotizacion', [
      "estatus" => $estatus,
    ]);
  }

  public function createCotizacion(Request $request){
    dd($request);
  }
}
