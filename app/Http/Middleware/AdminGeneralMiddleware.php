<?php

namespace App\Http\Middleware;

use App\User;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGeneralMiddleware
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
       * Si la variable tenantName esta vacía
       * Se obtiene el ID del usuario autenticado, y se hace una consulta para obtener el nombre de usuario y rol
       * Se hace una validación de que el usuario este autenticado, que el rol sea 1 y el nombre del rol sea 'Administrador General'
       */
      $id = Auth::user()->id; // ID del usuario logueado
      $consulta = User::join('roles', 'users.rol_id', '=', 'roles.rol_id')
        ->select('users.name', 'roles.nombre_rol AS NombreRol')
        ->where('users.id', "=", $id)
        ->get();
      if ((auth()->check()) && (auth()->user()->rol_id === 1) && ($consulta[0]->NombreRol === 'Administrador General')) {
        return $next($request);
      }
      return redirect('empresas');
    } else {
      /**
       * Si tenantName tiene un valor, entonces se está dentro del sitio de una empresa(hostname)
       * Y por ende se le redirige al home ya que no puedo acceder a las rutas de este middleware
       */
      return redirect('/home');
    }
  }
}
