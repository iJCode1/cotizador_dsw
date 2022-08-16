<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('municipios', function (Blueprint $table) {
      $table->increments('municipio_id');
      $table->string('clave', 3);
      $table->string('nombre', 100);
      $table->string('activo', 1);
      
      $table->integer('estado_id')->unsigned();
      $table->foreign('estado_id')->references('estado_id')->on('estados');

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
    Schema::dropIfExists('municipios');
  }
}
