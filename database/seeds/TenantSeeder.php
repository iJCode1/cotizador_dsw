<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // factory(\App\Models\Tenant\Roles::class, 2)->create();
    factory(\App\Models\Tenant\Roles::class, 1)->create();
    $roles = ["Administrador", "Empleado"];
    foreach ($roles as $rol) {
      DB::table('roles')->insert([
        'nombre_rol' => $rol,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }

  public function roles()
  {
    $roles = ["Administrador", "Empleado"];
    foreach ($roles as $rol) {
      DB::table('roles')->insert([
        'nombre_rol' => $rol,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }
}
