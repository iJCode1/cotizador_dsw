<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Productos_Servicios extends Model
{
  protected $primaryKey = 'producto_servicio_id';
  protected $fillable = ['producto_servicio_id', 'nombre', 'descripcion', 'codigo', 'imagen', 'precio_bruto', 'tipo_id', 'unidad_medida_id'];
}