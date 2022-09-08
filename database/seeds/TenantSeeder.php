<?php

if (!isset($_SESSION)) {
  session_start();
}

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
    // factory(\App\Models\Tenant\Roles::class, 1)->create();
    $this->roles();
    $this->unidadesDeMedida();
    $this->sesion();
  }

  public function roles()
  {
    $roles = ["Administrador Empresa", "Empleado", "Cliente"];
    foreach ($roles as $rol) {
      DB::table('roles')->insert([
        'nombre_rol' => $rol,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }

  public function unidadesDeMedida()
  {
    $unidades = array(
      array("unidad", "UN"),
      array("gramos", "G"),
      array("kilogramos", "KG"),
      array("mililitros", "ML"),
      array("litros", "L"),
    );
    // var_dump($unidades);
    foreach ($unidades as $unidad) {
      DB::table('unidades_de_medida')->insert([
        'nombre_unidad' => $unidad[0],
        'abrev' => $unidad[1],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }

  public function sesion()
  {
    if (isset($_SESSION)) {
      DB::table('users')->insert([
        'name' => $_SESSION['name'],
        'email' => $_SESSION['email'],
        'password' => $_SESSION['password'],
        'rol_id' => 1,
      ]);
    }
  }
}
