<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "empresa";
  protected $primaryKey = 'empresa_id';
  protected $fillable = ['empresa_id', 'direccion', 'codigo_postal', 'rfc', 'imagen', 'nombre_contacto', 'apellido_p', 'apellido_m', 'telefono', 'fqdn'];

}