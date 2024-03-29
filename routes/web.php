<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\User;

use App\Http\Controllers\EmpresaController;
use App\Models\Website;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

  $tenantName = null;

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
  if ($hostname) {
    $fqdn = $hostname->fqdn;
    $tenantName = explode('.', $fqdn)[0];
  }

  if (!$tenantName) {
    return redirect()->route('login');
  }else{
    return redirect()->route('tenant.login');
  }

});

/**
 * Rutas de autenticación Sistema general
 */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginCustomerController::class, 'customerLogin']);

/**
 * Rutas de un Administrador General
 */
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas');
Route::get('/empresa', [EmpresaController::class, 'altaEmpresa'])->name('altaEmpresa');
Route::post('/empresa/register', [EmpresaController::class, 'registrarEmpresa'])->name('registrarEmpresa');
Route::get('/empresa/{id}/desactivar', [EmpresaController::class, 'desactivarEmpresa'])->name('desactivarEmpresa');
Route::get('/empresa/{id}/activar', [EmpresaController::class, 'activateEmpresa'])->name('activateEmpresa');
Route::get('/empresa/{id}/info', [EmpresaController::class, 'showEmpresa'])->name('showEmpresa');
Route::get('/empresa/{id}/editar', [EmpresaController::class, 'editarEmpresa'])->name('editarEmpresa');
Route::put('empresa/{id}', [EmpresaController::class, 'actualizarEmpresa'])->name('actualizarEmpresa');

/**
 * Rutas de Autenticación (Administrador y Empleados de empresa)
 */
Route::get('login/admin', [LoginController::class, 'showLoginForm'])->name('loginAdmin');
Route::post('login/admin', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', 'HomeController@index')->name('home');
