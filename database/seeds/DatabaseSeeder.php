<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $this->call(UserSeeder::class);
    $this->roles();
    factory(App\User::class, 1)->create();
  }

  public function roles()
  {
    $roles = ["Administrador General", "Empleado"];
    foreach ($roles as $rol) {
      DB::table('roles')->insert([
        'nombre_rol' => $rol,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }
}
