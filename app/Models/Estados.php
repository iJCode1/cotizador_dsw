<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
  protected $primaryKey = 'estado_id';
  protected $fillable = ['estado_id', 'clave', 'nombre', 'abrev', 'activo'];
}