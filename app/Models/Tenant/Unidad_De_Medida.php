<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Unidad_De_Medida extends Authenticatable
{
  use Notifiable, UsesTenantConnection;

  protected $table = "unidades_de_medida";
  protected $primaryKey = 'unidad_medida_id';
  protected $fillable = ['unidad_medida_id', 'nombre_unidad', 'abrev'];
}