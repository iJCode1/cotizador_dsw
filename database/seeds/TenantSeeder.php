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
    $this->tiposProductosYServicios();
    $this->estatusCotizaciones();
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
      // array("gramos", "G"),
      // array("kilogramos", "KG"),
      // array("mililitros", "ML"),
      // array("litros", "L"),
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

  public function tiposProductosYServicios()
  {
    $tipos = ["Producto", "Servicio"];
    foreach ($tipos as $nombreTipo) {
      DB::table('tipo_productos_servicios')->insert([
        'nombre_tipo' => $nombreTipo,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }

  private function estatusCotizaciones()
  {
    $estatus = ["Enviado", "Aprobado", "Rechazado", "Pagado"];
    foreach ($estatus as $estatu) {
      DB::table('estatus_cotizaciones')->insert([
        'estatus' => $estatu,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
  }

  public function sesion()
  {
    if (isset($_SESSION)) {
      DB::table('users')->insert([
        'nombre' => $_SESSION['name_contact'],
        'apellido_p' => $_SESSION['lastname1'],
        'apellido_m' => $_SESSION['lastname2'],
        'email' => $_SESSION['email'],
        'password' => $_SESSION['password'],
        'direccion' => $_SESSION['address'],
        'telefono' => $_SESSION['phone'],
        'rol_id' => 1,
      ]);

      DB::table('empresa')->insert([
        'direccion' => $_SESSION['address'],
        'codigo_postal' => $_SESSION['codigo_postal'],
        'rfc' => $_SESSION['rfc'],
        'imagen' => $_SESSION['imagen'],
        'nombre_contacto' => $_SESSION['name_contact'],
        'apellido_p' => $_SESSION['lastname1'],
        'apellido_m' => $_SESSION['lastname2'],
        'telefono' => $_SESSION['phone'],
        'fqdn' => $_SESSION['fqdn'],
      ]);
    }
  }
}
