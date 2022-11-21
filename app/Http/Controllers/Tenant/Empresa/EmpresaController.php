<?php

namespace App\Http\Controllers\Tenant\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
  /**
   * Función editarEmpresa()
   * Obtiene la información de la empresa
   */
  public function editarEmpresa()
  {
    $empresaFind = Empresa::find(1)->first();

    return view('system.empresa.editar', [
      'empresa' => $empresaFind,
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
      'rfc' => 'required|between:13,13',
    ];

    $customMessages = [
      'address.required' => 'La dirección es obligatoria.',
      'address.string' => 'Se han introducido valores inválidos en la dirección.',
      'address.min' => 'La dirección debe contener al menos 1 carácter.',
      'postal.required' => 'El código postal es obligatorio.',
      'postal.digits_between' => 'El código postal debe ser de 5 dígitos.',
      'rfc.required' => 'El RFC es obligatorio.',
      'rfc.between' => 'El RFC debe ser de 13 caracteres.',
    ];

    $validator = Validator::make($request->all(), $rules, $customMessages);

    if ($validator->fails()) {
      return redirect("/empresa")
        ->withInput()
        ->withErrors($validator);
      } else {
        $empresa = Empresa::find(1)->first();

        // Se prepara la imágen para ser almacenada dentro de la carpeta 'images > productos_servicios/'
        $file = $request->file('imagen'); // Se obtiene la imagen
        // $img2 = "no-image.webp";
        if ($file) { // Si la imagen es diferente de vacio
          $imgDestination = 'images/logotipos/';
          $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
          $img2 = time() . '-' . $img; // Se concatena el nombre de la imagen
          $request->file('imagen')->move($imgDestination, $img2);
          $empresa->imagen = $img2;
        }
        $empresa->direccion = $request->address;
        $empresa->codigo_postal = $request->postal;
        $empresa->rfc = $request->rfc;
        $empresa->update();

      return redirect()->route("tenant.showServicios")
        ->with('editarE', 'ok');;
    }
    
  }
}
