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
  protected $fillable = ['cotizacion_id', 'folio_cotizacion', 'descripcion', 'fecha_creacion', 'vigencia', 'usuario_id', 'estatus_cotizacion_id', 'cliente_id'];

  public function estatus_cotizacion()
  {
    return $this->belongsTo('App\Models\Tenant\Estatus_Cotizacion', 'estatus_cotizacion_id', 'estatus_cotizacion_id');
  }

  public function cliente()
  {
    return $this->belongsTo('App\Models\Tenant\Cliente', 'cliente_id', 'cliente_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'usuario_id', 'user_id');
  }

  public function cotizaciones()
  {
    return $this->belongsTo(Detalle_Cotizacion::class, 'cotizacion_id', 'detalle_cotizacion_id');
  }
}
