<?php

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
Route::get('/altaempresa', [EmpresaController::class, 'altaempresa'])->name('altaempresa');
Route::post('/registrarempresa', [EmpresaController::class, 'registrarempresa'])->name('registrarempresa');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
