<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesDeMedidaTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('unidades_de_medida', function(Blueprint $table){
      $table->increments('unidad_medida_id');
      $table->string('nombre_unidad', 45);
      $table->string('abrev', 5);

      $table->rememberToken();

      $table->softDeletesTz('deleted_at');
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
    Schema::drop('unidades_de_medida');
  }
}
