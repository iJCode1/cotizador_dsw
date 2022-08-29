<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Unidad_De_Medida extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'unidad_medida_id';
  protected $fillable = ['unidad_medida_id', 'nombre_unidad', 'abrev'];
}