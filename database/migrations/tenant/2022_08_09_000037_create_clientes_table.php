<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('clientes', function(Blueprint $table){
      $table->increments('cliente_id');
      $table->string('nombre', 45);
      $table->string('apellido_p', 45);
      $table->string('apellido_m', 45);
      $table->string('direccion', 255);
      $table->string('telefono', 10);
      $table->string('correo_electronico', 100);
      $table->string('contraseña', 50);
      
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
    Schema::drop('clientes');
  }
}
