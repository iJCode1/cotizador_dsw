<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'rol_id';
  protected $fillable = ['rol_id', 'nombre_rol'];
}
