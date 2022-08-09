<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Detalle_Cotizaciones extends Model
{
  protected $primaryKey = 'detalle_cotizacion_id';
  protected $fillable = ['detalle_cotizacion_id', 'cantidad', 'precio_bruto', 'subtotal', 'iva', 'descuento', 'cotizacion_id', 'producto_servicio_id'];
}