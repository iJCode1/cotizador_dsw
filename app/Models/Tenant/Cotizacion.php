<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cotizacion extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "cotizaciones";
  protected $primaryKey = 'cotizacion_id';
  protected $fillable = ['cotizacion_id', 'nombre_cotizacion', 'descripcion', 'fecha_creacion', 'vigencia', 'usuario_id', 'estatus_cotizacion_id', 'cliente_id'];
}