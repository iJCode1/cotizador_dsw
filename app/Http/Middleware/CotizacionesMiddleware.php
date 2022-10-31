<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CotizacionesMiddleware
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
    if (($guard->check()) || (Auth::check()) ) {
      return $next($request);
    }
    return redirect('login');
  }
}
