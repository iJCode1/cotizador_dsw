<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Estatus_Cotizacion extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "estatus_cotizaciones";
  protected $primaryKey = 'estatus_cotizacion_id';
  protected $fillable = ['estatus_cotizacion_id', 'estatus'];
}