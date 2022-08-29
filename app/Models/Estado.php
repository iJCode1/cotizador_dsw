<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
  protected $table = "estados";
  protected $primaryKey = 'estado_id';
  protected $fillable = ['estado_id', 'clave', 'nombre', 'abrev', 'activo'];
}
