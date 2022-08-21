<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
  protected $primaryKey = 'empresa_id';
  protected $fillable = ['empresa_id', 'fqdn', 'direccion', 'codigo_postal', 'numero', 'rfc', 'nombre_contacto', 'telefono', 'correo_electronico', 'contraseña', 'municipio_id', 'usuario_id', 'website_id'];
}
