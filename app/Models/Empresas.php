<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresas extends Model
{
  use SoftDeletes;
  protected $primaryKey = 'empresa_id';
  protected $fillable = ['empresa_id', 'direccion', 'codigo_postal', 'numero', 'rfc', 'nombre_contacto', 'telefono', 'correo_electronico', 'contraseña', 'usuario_id', 'municipio_id', 'hostname_id', 'fqdn'];
}
