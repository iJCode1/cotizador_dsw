<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
  use SoftDeletes;
  protected $table = "empresas";
  protected $primaryKey = 'empresa_id';
  protected $fillable = ['empresa_id', 'direccion', 'codigo_postal', 'rfc', 'imagen', 'nombre_contacto', 'apellido_p', 'apellido_m', 'telefono', 'correo_electronico', 'contraseña', 'usuario_id', 'municipio_id', 'hostname_id', 'fqdn'];

  public function hostname()
  {
    return $this->belongsTo('App\Models\Hostname', 'hostname_id', 'id');
  }
}
