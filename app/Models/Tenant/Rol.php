<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rol extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "roles";
  protected $primaryKey = 'rol_id';
  protected $fillable = ['rol_id', 'nombre_rol'];

  public function user()
  {
    return $this->hasOne('App\Models\Tenant\User');
  }

  public function customer()
  {
    return $this->hasOne('App\Models\Tenant\Cliente');
  }
}
