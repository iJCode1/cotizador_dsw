<?php

// use App\Models\Tenant\Usuario;

use App\Http\Controllers\Tenant\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
      ->namespace('App\Http\Controllers')
      ->as('tenant.')
      ->group(function(){
        
      });