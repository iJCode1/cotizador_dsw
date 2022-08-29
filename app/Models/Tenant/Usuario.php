<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  protected $table = "usuarios";
  protected $primaryKey = 'usuario_id';
  protected $fillable = ['usuario_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'correo_electronico', 'contraseña', 'rol_id'];
}