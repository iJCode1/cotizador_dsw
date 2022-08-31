<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "clientes";
  protected $primaryKey = 'cliente_id';
  protected $fillable = ['cliente_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'correo_electronico', 'contraseña'];
}