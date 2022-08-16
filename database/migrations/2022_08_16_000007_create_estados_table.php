<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('estados', function (Blueprint $table) {
      $table->increments('estado_id');
      $table->string('clave', 2);
      $table->string('nombre', 40);
      $table->string('abrev', 10);
      $table->string('activo', 1);

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
    Schema::dropIfExists('estados');
  }
}
