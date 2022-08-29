<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Estatus_Cotizacion extends Model
{
  use UsesTenantConnection;
  protected $table = "estatus_cotizaciones";
  protected $primaryKey = 'estatus_cotizacion_id';
  protected $fillable = ['estatus_cotizacion_id', 'estatus'];
}