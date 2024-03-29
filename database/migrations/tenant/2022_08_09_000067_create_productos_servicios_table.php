<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosServiciosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('productos_servicios', function (Blueprint $table) {
      $table->increments('producto_servicio_id');
      $table->string('nombre', 255);
      $table->longText('descripcion');
      $table->string('codigo', 45);
      $table->string('imagen', 255);
      $table->float('precio_bruto',);

      // Llaves foraneas
      $table->integer('tipo_id')->unsigned();
      $table->foreign('tipo_id')->references('tipo_id')->on('tipo_productos_servicios');

      $table->integer('unidad_medida_id')->unsigned();
      $table->foreign('unidad_medida_id')->references('unidad_medida_id')->on('unidades_de_medida');

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
    Schema::drop('productos_servicios');
  }
}
