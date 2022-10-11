<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Unidad_De_Medida;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnidadesDeMedidaController extends Controller
{
  /**
   * Función index()
   * Muestra las unidades de medida que se han registrado
   */
  public function index()
  {
    $unidades = Unidad_De_Medida::withTrashed()
      ->get();

    return view('system.unidades.index', [
      "unidades" => $unidades,
    ]);
  }

  /**
   * Función showRegisterUnidad()
   * Retorna la vista de registro de unidades de medida
   */
  public function showRegisterUnidad()
  {
    return view('system.unidades.register');
  }

  /**
   * Función registerUnidad()
   * Hace la validación de los campos al registrar una nueva unidad de medida
   * Si los datos son validos, registra la unidad de medida
   */
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

  /**
   * Función showEditUnidad()
   * Retorna la vista para editar la unidad de medida seleccionada
   */
  public function showEditUnidad($unidad)
  {

    $unidadFind = Unidad_De_Medida::withTrashed()->find($unidad);
    return view('system.unidades.edit', [
      "unidad" => $unidadFind,
    ]);
  }

  /**
   * Función editUnidad()
   * Valida que los nuevos datos de la unidad sean validos
   * Si los datos son validos, actualiza el registro en la BD
   */
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

  /**
   * Función deleteUnidad()
   * Hace una baja lógica de la unidad de medida seleccionada
   */
  public function deleteUnidad($unidad_id)
  {
    Unidad_De_Medida::withTrashed()->find($unidad_id)
      ->delete();
    return redirect()->route('tenant.unidades')
      ->with('eliminar', 'ok');
  }

  /**
   * Función activateUnidad()
   * Quita la baja lógica del registro seleccionado
   */
  public function activateUnidad($unidad_id)
  {
    Unidad_De_Medida::withTrashed()
      ->find($unidad_id)
      ->restore();
    return redirect()->route('tenant.unidades')
      ->with('activar', 'ok');
  }
}
