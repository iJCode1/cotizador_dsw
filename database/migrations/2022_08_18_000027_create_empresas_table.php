<?php

use Hyn\Tenancy\Abstracts\AbstractMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends AbstractMigration
{
  protected $system = true;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('empresa_id');
            $table->string('fqdn', 100);
            // $table->string('uuid');
            $table->string('direccion', 255);
            $table->string('codigo_postal', 5);
            $table->string('numero', 10);
            $table->string('rfc', 13);
            $table->string('nombre_contacto', 45);
            $table->string('telefono', 10);
            $table->string('correo_electronico', 50);
            $table->string('contraseña');

            $table->bigInteger('municipio_id')->unsigned()->nullable();
            $table->foreign('municipio_id')->references('municipio_id')->on('municipios')->onDelete('set null');
            
            $table->bigInteger('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');

            $table->bigInteger('website_id')->unsigned()->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
