<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Tipo_Producto_Servicio extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'tipo_id';
  protected $fillable = ['tipo_id', 'nombre_tipo'];
}