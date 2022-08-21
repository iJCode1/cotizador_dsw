<?php

namespace App\Http\Middleware;

use App\User;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGeneralMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $id = Auth::user()->id; // ID del usuario logueado
    $consulta = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
      ->select('users.name', 'roles.nombre_rol AS NombreRol')
      ->where('users.id', "=", $id)
      ->get();
    if ((auth()->check()) && (auth()->user()->rol_id === 1) && ($consulta[0]->NombreRol === 'Administrador General')) {
      return $next($request);
    }

    return redirect('/');
  }
}
