<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Tipo_Productos_Servicios extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'tipo_id';
  protected $fillable = ['tipo_id', 'nombre_tipo'];
}