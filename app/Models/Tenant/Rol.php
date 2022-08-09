<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
  protected $primaryKey = 'rol_id';
  protected $fillable = ['rol_id', 'nombre_rol'];
}