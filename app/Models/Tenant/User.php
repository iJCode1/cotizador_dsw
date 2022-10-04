<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use SoftDeletes;
  use Notifiable, UsesTenantConnection;

  protected $table = "users";

  protected $primaryKey = 'user_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'nombre', 'apellido_p', 'apellido_m', 'direccion', 'telefono', 'email', 'password', 'rol_id',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function rol()
  {
    return $this->belongsTo('App\Models\Tenant\Rol', 'rol_id', 'rol_id');
  }
}
