<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Detalle_Cotizacion extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "detalle_cotizaciones";
  protected $primaryKey = 'detalle_cotizacion_id';
  protected $fillable = ['detalle_cotizacion_id', 'cantidad', 'precio_bruto', 'subtotal', 'iva', 'descuento', 'cotizacion_id', 'producto_servicio_id'];

  public function cotizacion()
  {
    return $this->hasOne('App\Models\Tenant\Cotizacion', 'cotizacion_id', 'cotizacion_id');
  }

  public function producto_servicio()
  {
    return $this->hasMany('App\Models\Tenant\Producto_Servicio', 'producto_servicio_id', 'producto_servicio_id');
  }
}
