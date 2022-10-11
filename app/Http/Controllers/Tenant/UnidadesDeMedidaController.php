<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Unidad_De_Medida;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadesDeMedidaController extends Controller
{
  public function index()
  {
    $unidades = Unidad_De_Medida::withTrashed()
      ->get();

    return view('system.unidades.index', [
      "unidades" => $unidades,
    ]);
  }

  public function showRegisterUnidad()
  {
    // $unidades = Unidad_De_Medida::all();
    // dd(count($unidades));
    return view('system.unidades.register');
  }

  public function registerUnidad(Request $request)
  {
    $request->validate([
      'nombre' => 'required|min:1|max:45|unique:tenant.unidades_de_medida,nombre_unidad',
      'abrev' => 'required|min:1|max:5|unique:tenant.unidades_de_medida,abrev',
    ]);

    $unidad = [
      'nombre_unidad' => $request->nombre,
      'abrev' => $request->abrev,
    ];

    Unidad_De_Medida::create($unidad);

    return redirect()->route('tenant.unidades')
      ->with('crear', 'ok');
  }

  public function showEditUnidad($unidad)
  {

    $unidadFind = Unidad_De_Medida::withTrashed()->find($unidad);
    return view('system.unidades.edit', [
      "unidad" => $unidadFind,
    ]);
  }

  public function editUnidad(Request $request, $unidadID)
  {
    // dd($request);
    $request->validate([
      'nombre_unidad' => 'required|min:1|max:45',
      'abrev' => ['required','min:1','max:5',Rule::unique('tenant.unidades_de_medida')->ignore($unidadID, 'unidad_medida_id')],
    ]);


    $unidad = Unidad_De_Medida::withTrashed()->find($unidadID);

    $unidad->nombre_unidad = $request->nombre_unidad;
    $unidad->abrev = $request->abrev;
    $unidad->update();

    return redirect()->route("tenant.unidades")
      ->with('editar', 'ok');
  }

  public function deleteUnidad($unidad_id)
  {
    Unidad_De_Medida::withTrashed()->find($unidad_id)
      ->delete();
    return redirect()->route('tenant.unidades')
      ->with('eliminar', 'ok');
  }

  public function activateUnidad($unidad_id)
  {
    Unidad_De_Medida::withTrashed()
      ->find($unidad_id)
      ->restore();
    return redirect()->route('tenant.unidades')
      ->with('activar', 'ok');
  }
}
