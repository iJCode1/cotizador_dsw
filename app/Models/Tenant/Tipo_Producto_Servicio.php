<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tipo_Producto_Servicio extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "tipo_productos_servicios";
  protected $primaryKey = 'tipo_id';
  protected $fillable = ['tipo_id', 'nombre_tipo'];
}