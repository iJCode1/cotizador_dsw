<?php

use App\Http\Controllers\Tenant\Cliente\ClienteController;
use App\Http\Controllers\Tenant\Cliente\LoginCustomerController;
use App\Http\Controllers\Tenant\Cliente\RegisterCustomerController;
use App\Http\Controllers\Tenant\Cotizaciones\CotizacionesController;
use App\Http\Controllers\Tenant\ServiciosController;
use App\Http\Controllers\Tenant\UnidadesDeMedidaController;
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
     * Rutas para unidades de medida (Administrador y Empleado)
     */
    Route::get('/unidades', [UnidadesDeMedidaController::class, 'index'])->name('unidades');
    Route::get('/unidad', [UnidadesDeMedidaController::class, 'showRegisterUnidad'])->name('showRegisterUnidad');
    Route::post('/unidad/register', [UnidadesDeMedidaController::class, 'registerUnidad'])->name('registerUnidad');
    Route::get('/unidad/{unidad_id}/edit', [UnidadesDeMedidaController::class, 'showEditUnidad'])->name('showEditUnidad');
    Route::put('/unidad/{unidad_id}', [UnidadesDeMedidaController::class, 'editUnidad'])->name('editUnidad');
    Route::get('/unidad/{unidad_id}/delete', [UnidadesDeMedidaController::class, 'deleteUnidad'])->name('deleteUnidad');
    Route::get('/unidad/{unidad_id}/activate', [UnidadesDeMedidaController::class, 'activateUnidad'])->name('activateUnidad');

    /**
     * Rutas para clientes
     */
    Route::get('register', [RegisterCustomerController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterCustomerController::class, 'registerCustomer']);

    Route::get('/login', [LoginCustomerController::class, 'showCustomerLoginForm'])->name('login');
    Route::post('/login', [LoginCustomerController::class, 'customerLogin']);

    Route::get('/cliente', [ClienteController::class, 'showCliente']);

    Route::get('cliente/index', [ClienteController::class, 'index'])->name('index');

    /**
     * Rutas de cotizaciones para todos
     */
    Route::get('/cotizaciones', [CotizacionesController::class, 'index'])->name('cotizaciones');
    Route::get('/cotizacion', [CotizacionesController::class, 'showCotizacionForm'])->name('cotizacion');
    Route::post('/cotizacion', [CotizacionesController::class, 'createCotizacion'])->name('cotizacion');
    Route::post('/buscarCliente', [CotizacionesController::class, 'buscarCliente'])->name('buscarCliente');
    Route::post('/seleccionarCliente', [CotizacionesController::class, 'seleccionarCliente'])->name('seleccionarCliente');
    Route::post('/buscarServicio', [CotizacionesController::class, 'buscarServicio'])->name('buscarServicio');
    Route::post('/seleccionarServicio', [CotizacionesController::class, 'seleccionarServicio'])->name('seleccionarServicio');
    Route::post('/registrarCliente', [CotizacionesController::class, 'registrarCliente'])->name('registrarCliente');
    Route::post('/registrarServicio', [CotizacionesController::class, 'registrarServicio'])->name('registrarServicio');
    Route::get('/cotizacion/{id}/editar', [CotizacionesController::class, 'showCotizacionEditForm'])->name('showCotizacionEditForm');
    Route::put('/cotizacion/{id}', [CotizacionesController::class, 'editCotizacion'])->name('editCotizacion');

  });