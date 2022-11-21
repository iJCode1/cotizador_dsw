<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Unidad_De_Medida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UnidadesDeMedidaController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('userInterno');
  }

  /**
   * Función index()
   * Muestra las unidades de medida que se han registrado en la BD
   */
  public function index()
  {
    $unidades = Unidad_De_Medida::withTrashed()
      ->latest()->paginate(10);

    return view('system.unidades.index', [
      "unidades" => $unidades,
    ]);
  }

  /**
   * Función showRegisterUnidad()
   * Retorna la vista de registro de unidad de medida
   */
  public function showRegisterUnidad()
  {
    return view('system.unidades.register');
  }

  /**
   * Función registerUnidad()
   * Hace la validación de los campos al registrar una nueva unidad de medida
   * Si los datos son válidos, registra la unidad de medida
   * Si no son válidos regresa a la vista anterior y muestra errores
   */
  public function registerUnidad(Request $request)
  {

    $rules = [
      'nombre' => 'required|min:1|max:45|unique:tenant.unidades_de_medida,nombre_unidad',
      'abrev' => 'required|min:1|max:5|unique:tenant.unidades_de_medida,abrev',
    ];

    $customMessages = [
      'nombre.required' => 'El nombre es obligatorio.',
      'nombre.min' => 'El nombre debe contener al menos un carácter.',
      'nombre.max' => 'El nombre no debe contener más de 45 caracteres.',
      'nombre.unique' => 'El nombre ya fue registrado.',
      'abrev.required' => 'La abreviación es obligatoria.',
      'abrev.min' => 'La abreviación debe contener al menos un carácter.',
      'abrev.max' => 'La abreviación no debe contener más de 5 caracteres.',
      'abrev.unique' => 'La abreviación ya fue registrada.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/unidad")
        ->withErrors($validator)
        ->withInput();
    } else {
      $unidad = [
        'nombre_unidad' => $request->nombre,
        'abrev' => $request->abrev,
      ];

      Unidad_De_Medida::create($unidad);

      return redirect()->route('tenant.unidades')
        ->with('crear', 'ok');
    }
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
   * Válida que los nuevos datos de la unidad sean válidos
   * Si los datos son válidos, actualiza el registro en la BD
   */
  public function editUnidad(Request $request, $unidadID)
  {

    $rules = [
      'nombre_unidad' => ['required', 'min:1', 'max:45', Rule::unique('tenant.unidades_de_medida')->ignore($unidadID, 'unidad_medida_id')],
      'abrev' => ['required', 'min:1', 'max:5', Rule::unique('tenant.unidades_de_medida')->ignore($unidadID, 'unidad_medida_id')],
    ];

    $customMessages = [
      'nombre.required' => 'El nombre es obligatorio.',
      'nombre.min' => 'El nombre debe contener al menos un carácter.',
      'nombre.max' => 'El nombre no debe contener más de 45 caracteres.',
      'nombre.unique' => 'El nombre ya fue registrado.',
      'abrev.required' => 'La abreviación es obligatoria.',
      'abrev.min' => 'La abreviación debe contener al menos un carácter.',
      'abrev.max' => 'La abreviación no debe contener más de 5 caracteres.',
      'abrev.unique' => 'La abreviación ya fue registrada.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/unidad/$unidadID/edit")
        ->withErrors($validator)
        ->withInput();
    } else {
      $unidad = Unidad_De_Medida::withTrashed()->find($unidadID);

      $unidad->nombre_unidad = $request->nombre_unidad;
      $unidad->abrev = $request->abrev;
      $unidad->update();

      return redirect()->route("tenant.unidades")
        ->with('editar', 'ok');
    }
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
   * Activa nuevamente el registro seleccionado (quita baja lógica)
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
