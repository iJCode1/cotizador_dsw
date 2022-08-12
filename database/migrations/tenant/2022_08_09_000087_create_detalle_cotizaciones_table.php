<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCotizacionesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('detalle_cotizaciones', function(Blueprint $table){
      $table->increments('detalle_cotizacion_id');
      $table->integer('cantidad')->unsigned();
      $table->float('precio_bruto', );
      $table->float('subtotal', );
      $table->float('iva', );
      $table->float('descuento', );

      // Llaves foraneas
      $table->integer('cotizacion_id')->unsigned();
      $table->foreign('cotizacion_id')->references('cotizacion_id')->on('cotizaciones');
      
      $table->integer('producto_servicio_id')->unsigned();
      $table->foreign('producto_servicio_id')->references('producto_servicio_id')->on('productos_servicios');

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
    Schema::drop('detalle_cotizaciones');
  }
}
