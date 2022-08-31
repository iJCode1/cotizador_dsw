<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "usuarios";
  protected $primaryKey = 'usuario_id';
  protected $fillable = ['usuario_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'correo_electronico', 'contraseña', 'rol_id'];
}