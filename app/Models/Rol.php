<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
  use UsesTenantConnection;
  protected $table = "roles";
  protected $primaryKey = 'rol_id';
  protected $fillable = ['rol_id', 'nombre_rol'];

  public function user()
  {
    return $this->hasOne('App\User');
  }
}
