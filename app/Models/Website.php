<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
  use SoftDeletes;

  protected $table = "websites";
  protected $primaryKey = 'id';
  protected $fillable = ['id', 'uuid', 'deleted_at'];
}
