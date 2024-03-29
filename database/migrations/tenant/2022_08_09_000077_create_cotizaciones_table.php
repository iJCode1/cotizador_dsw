<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cotizaciones', function (Blueprint $table) {
      $table->increments('cotizacion_id');
      $table->string('folio_cotizacion', 255);
      $table->longText('descripcion');
      $table->date('fecha_creacion', 45);
      $table->string('vigencia', 45);

      // Llaves foraneas
      $table->integer('usuario_id')->unsigned();
      $table->foreign('usuario_id')->references('user_id')->on('users');

      $table->integer('estatus_cotizacion_id')->unsigned();
      $table->foreign('estatus_cotizacion_id')->references('estatus_cotizacion_id')->on('estatus_cotizaciones');

      $table->integer('cliente_id')->unsigned();
      $table->foreign('cliente_id')->references('cliente_id')->on('clientes');

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
    Schema::drop('cotizaciones');
  }
}
