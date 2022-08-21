<?php

namespace App\Providers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // $id = Auth::user(); // ID del usuario logueado
    // // Consulta entre 2 tablas - Users y Roles
    // $user = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
    //   ->select('users.name', 'roles.nombre_rol AS NombreRol')
    //   ->where('users.id', "=", $id)
    //   ->get();
    //   // dd($id);
    //   View::share('user', $user);
    // // view()->share('user', $user);
  }
}
