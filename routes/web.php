<?php

use App\User;

use App\Http\Controllers\EmpresaController;
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
  return view('welcome');
});

/**
 * Rutas de un Administrador General
 */
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas');
Route::get('/empresa', [EmpresaController::class, 'altaEmpresa'])->name('altaEmpresa');
Route::post('/empresa/register', [EmpresaController::class, 'registrarEmpresa'])->name('registrarEmpresa');
Route::get('/empresa/{id}/desactivar', [EmpresaController::class, 'desactivarEmpresa'])->name('desactivarEmpresa');
Route::get('/empresa/{id}/editar', [EmpresaController::class, 'editarEmpresa'])->name('editarEmpresa');
Route::put('empresa/{id}', [EmpresaController::class, 'actualizarEmpresa'])->name('actualizarEmpresa');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
