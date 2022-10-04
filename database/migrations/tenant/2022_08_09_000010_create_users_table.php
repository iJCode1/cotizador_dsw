<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('user_id');
      $table->string('nombre');
      $table->string('apellido_p', 45)->nullable();
      $table->string('apellido_m', 45)->nullable();
      $table->string('direccion', 255)->nullable();
      $table->string('telefono', 10)->nullable();
      $table->string('email', 100)->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');

      $table->bigInteger('rol_id')->unsigned()->nullable();
      $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('set null');

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
    Schema::dropIfExists('users');
  }
}
