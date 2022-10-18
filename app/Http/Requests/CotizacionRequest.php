<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotizacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          // 'nombre_cot' => ['required'],
          // 'descripcion_cot' => ['required'],
          // 'fecha_creacion' => ['required'],
          // 'numero_servicios' => ['required'],
          // 'servicio_id' => ['required','exists:productos_servicios,producto_servicio_id'],
        ];
    }
}
