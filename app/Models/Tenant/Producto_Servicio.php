<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Producto_Servicio extends Model
{
  use UsesTenantConnection;
  protected $table = "productos_servicios";
  protected $primaryKey = 'producto_servicio_id';
  protected $fillable = ['producto_servicio_id', 'nombre', 'descripcion', 'codigo', 'imagen', 'precio_bruto', 'tipo_id', 'unidad_medida_id'];
}