<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Roles;


$factory->define(Roles::class, function () {
  return [
    "nombre_rol" => "Admin",
    "created_at" => now()
  ];
});
