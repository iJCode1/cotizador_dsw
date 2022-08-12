<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;

class Clientes extends Model
{
  use UsesTenantConnection;
  protected $primaryKey = 'cliente_id';
  protected $fillable = ['cliente_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'correo_electronico', 'contraseña'];
}