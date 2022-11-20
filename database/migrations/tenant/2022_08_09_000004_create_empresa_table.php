<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('empresa', function(Blueprint $table){
      $table->bigIncrements('empresa_id');
      $table->string('direccion', 255);
      $table->string('codigo_postal', 5);
      $table->string('rfc', 13);
      $table->string('imagen', 255)->nullable();
      $table->string('nombre_contacto', 45);
      $table->string('apellido_p', 45);
      $table->string('apellido_m', 45);
      $table->string('telefono', 10);
      $table->string('fqdn');

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
    Schema::drop('empresa');
  }
}
