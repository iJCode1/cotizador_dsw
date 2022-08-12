<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Estatus_Cotizaciones extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'estatus_cotizacion_id';
  protected $fillable = ['estatus_cotizacion_id', 'estatus'];
}