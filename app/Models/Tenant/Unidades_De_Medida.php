<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Unidades_De_Medida extends Model
{
  protected $primaryKey = 'unidad_medida_id';
  protected $fillable = ['unidad_medida_id', 'nombre_unidad', 'abrev'];
}