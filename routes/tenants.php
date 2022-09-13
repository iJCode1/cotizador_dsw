<?php

// use App\Models\Tenant\Usuario;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Tenant\ServiciosController;
use App\Http\Controllers\Tenant\UsuariosController;
use App\Models\Tenant\Cliente;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
      ->namespace('App\Http\Controllers')
      ->as('tenant.')
      ->group(function(){
        /**
         * Rutas para Usuarios (Administrador)
         */
        Route::get('/empleados', [UsuariosController::class, 'index'])->name('showEmpleados');
        Route::get('/empleado', [UsuariosController::class, 'showRegister'])->name('showRegister');
        Route::post('/empleado/register', [UsuariosController::class, 'registerUser'])->name('registerUser');
        Route::get('/empleado/{usuario_id}/edit', [UsuariosController::class, 'showEditUser'])->name('showEditUser');
        Route::put('/empleado/{usuario_id}', [UsuariosController::class, 'editUser'])->name('editUser');
        Route::get('/empleado/{usuario_id}/delete', [UsuariosController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/empleado/{usuario_id}/activate', [UsuariosController::class, 'activateUser'])->name('activateUser');

        /**
         * Rutas para productos y/o servicios (Administrador y Empleado)
         */
        Route::get('/servicios', [ServiciosController::class, 'index'])->name('showServicios');
        Route::get('/servicio', [ServiciosController::class, 'showRegisterServicio'])->name('showRegisterServicio');
        Route::post('/servicio/register', [ServiciosController::class, 'registerServicio'])->name('registerServicio');
        Route::get('/servicio/{servicio_id}/edit', [ServiciosController::class, 'showEditServicio'])->name('showEditServicio');
        Route::put('servicio/{servicio_id}', [ServiciosController::class, 'editServicio'])->name('editServicio');
        Route::get('/servicio/{servicio_id}/delete', [ServiciosController::class, 'deleteServicio'])->name('deleteServicio');
        Route::get('/servicio/{servicio_id}/activate', [ServiciosController::class, 'activateServicio'])->name('activateServicio');

        /**
         * Rutas para clientes
         */
        Route::get('register', [ClienteController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [ClienteController::class, 'registerCustomer']);
      });