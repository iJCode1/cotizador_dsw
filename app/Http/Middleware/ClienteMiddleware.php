<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClienteMiddleware
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
    $guard = Auth::guard('cliente');
    if (($guard->check()) && ($guard->user()->rol_id === 3) && ($guard->user()->rol->nombre_rol === 'Cliente')) {
      return $next($request);
    }
    return redirect('login/cliente');
  }
}
