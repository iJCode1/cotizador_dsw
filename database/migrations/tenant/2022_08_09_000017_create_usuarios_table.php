<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('usuarios', function(Blueprint $table){
      $table->increments('usuario_id');
      $table->string('nombre', 45);
      $table->string('apellido_p', 45);
      $table->string('apellido_m', 45);
      $table->string('direccion', 255);
      $table->string('telefono', 10);
      $table->string('correo_electronico', 100);
      $table->string('contraseña', 50);

      // Llave foranea
      $table->bigInteger('rol_id')->unsigned();
      $table->foreign('rol_id')->references('rol_id')->on('roles');

      $table->softDeletesTz('deleted_at');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('usuarios');
  }
}
