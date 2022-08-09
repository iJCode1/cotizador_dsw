<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
  protected $primaryKey = 'cliente_id';
  protected $fillable = ['cliente_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'correo_electronico', 'contraseña'];
}