<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
  use UsesTenantConnection;
  protected $table = "roles";
  protected $primaryKey = 'rol_id';
  protected $fillable = ['rol_id', 'nombre_rol'];
}
