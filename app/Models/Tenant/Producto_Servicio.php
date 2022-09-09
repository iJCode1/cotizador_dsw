<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto_Servicio extends Authenticatable
{
  use Notifiable, UsesTenantConnection;
  use SoftDeletes;

  protected $table = "productos_servicios";
  protected $primaryKey = 'producto_servicio_id';
  protected $fillable = ['producto_servicio_id', 'nombre', 'descripcion', 'codigo', 'imagen', 'precio_bruto', 'tipo_id', 'unidad_medida_id'];

  public function tipo()
  {
    return $this->belongsTo('App\Models\Tenant\Tipo_Producto_Servicio', 'tipo_id', 'tipo_id');
  }

  public function unidad()
  {
    return $this->belongsTo('App\Models\Tenant\Unidad_De_Medida', 'unidad_medida_id', 'unidad_medida_id');
  }
}