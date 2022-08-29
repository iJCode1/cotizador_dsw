<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
  protected $table = "municipios";
  protected $primaryKey = 'municipio_id';
  protected $fillable = ['municipio_id', 'clave', 'nombre', 'activo', 'estado_id'];
}
