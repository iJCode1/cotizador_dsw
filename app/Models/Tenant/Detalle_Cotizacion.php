<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Detalle_Cotizacion extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'detalle_cotizacion_id';
  protected $fillable = ['detalle_cotizacion_id', 'cantidad', 'precio_bruto', 'subtotal', 'iva', 'descuento', 'cotizacion_id', 'producto_servicio_id'];
}