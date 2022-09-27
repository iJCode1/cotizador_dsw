<?php

use App\Http\Controllers\Tenant\Cliente\ClienteController;
use App\Http\Controllers\Tenant\Cliente\LoginCustomerController;
use App\Http\Controllers\Tenant\Cliente\RegisterCustomerController;
use App\Http\Controllers\Tenant\ServiciosController;
use App\Http\Controllers\Tenant\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
  ->namespace('App\Http\Controllers')
  ->as('tenant.')
  ->group(function () {
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
    Route::get('register', [RegisterCustomerController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterCustomerController::class, 'registerCustomer']);

    Route::get('/login', [LoginCustomerController::class, 'showCustomerLoginForm'])->name('login');
    Route::post('/login', [LoginCustomerController::class, 'customerLogin']);

    Route::get('/cliente', [ClienteController::class, 'showCliente']);

    Route::get('cliente/index', [ClienteController::class, 'index'])->name('index');
  });