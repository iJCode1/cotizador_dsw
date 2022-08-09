<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Tipo_Productos_Servicios extends Model
{
  protected $primaryKey = 'tipo_id';
  protected $fillable = ['tipo_id', 'nombre_tipo'];
}