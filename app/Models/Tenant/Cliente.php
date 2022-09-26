<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $guard = 'admin';

  protected $table = "clientes";
  protected $primaryKey = 'cliente_id';
  protected $fillable = ['cliente_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'email', 'password', 'rol_id'];

  public function rol()
  {
    return $this->belongsTo('App\Models\Tenant\Rol', 'rol_id', 'rol_id');
  }
}