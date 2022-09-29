<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostname extends Model
{
  protected $table = "hostnames";
  protected $primaryKey = 'id';
  protected $fillable = ['id', 'fqdn', 'redirect_to', 'force_https', 'under_maintenance_since', 'website_id'];

  public function website()
  {
    return $this->belongsTo('App\Models\Website', 'website_id', 'id');
  }
}
