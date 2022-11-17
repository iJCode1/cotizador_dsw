<?php

namespace App\Http\Middleware;

use Closure;

class UserInternoMiddleware
{
  /**
   * Variable $tenantName
   * Almacenara el nombre de una empresa si es que se encuentra dentro de una instacia de empresa(hostname)
   */
  protected $tenantName = null;


  /**
   * Función __construct()
   * Detectara si se encuentra actualmente en una instancia de empresa(hostname)
   * Si es el caso, obtendra el fqdn
   */
  public function __construct()
  {
    $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
    if ($hostname) {
      $fqdn = $hostname->fqdn;
      $this->tenantName = explode('.', $fqdn)[0];
    }
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (!$this->tenantName) {
      /**
       * Si tenantName no tiene un valor, entonces se está dentro del sitio general
       * Y por ende se le redirige al home ya que no puedo acceder a las rutas de este middleware
       */
      return redirect('/home');
    } else {
      /**
       * Si la variable tenantName no esta vacía
       * Se obtiene el rol del usuario autenticado
       * Se hace una validación de que el usuario este autenticado, que el rol sea 1 o 2 y el nombre del rol sea 'Administrador Empresa' o 'Empleado'
       */

      if ((auth()->check()) && (auth()->user()->rol_id === 1 || auth()->user()->rol_id === 2) && (auth()->user()->rol->nombre_rol === 'Administrador Empresa' || auth()->user()->rol->nombre_rol === 'Empleado')) {
        return $next($request);
      }
      return redirect('/login/admin');
    }
  }
}
