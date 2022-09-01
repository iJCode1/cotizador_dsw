<?php

// use App\Models\Tenant\Usuario;

use App\Http\Controllers\Tenant\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
      ->namespace('App\Http\Controllers')
      ->as('tenant.')
      ->group(function(){
        /**
         * Rutas para Usuarios (Administrador y Empleados)
         */
        Route::get('/empleados', [UsuariosController::class, 'index'])->name('showEmpleados');
        Route::get('/empleado', [UsuariosController::class, 'showRegister'])->name('showRegister');
        Route::post('/empleado/register', [UsuariosController::class, 'registerUser'])->name('registerUser');
        Route::get('/empleado/{usuario_id}/delete', [UsuariosController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/empleado/{usuario_id}/activate', [UsuariosController::class, 'activateUser'])->name('activateUser');
      });