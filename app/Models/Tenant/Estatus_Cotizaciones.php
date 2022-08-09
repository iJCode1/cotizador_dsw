<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Estatus_Cotizaciones extends Model
{
  protected $primaryKey = 'estatus_cotizacion_id';
  protected $fillable = ['estatus_cotizacion_id', 'estatus'];
}