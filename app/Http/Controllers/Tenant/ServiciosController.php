<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant\Tipo_Producto_Servicio;
use App\Models\Tenant\Unidad_De_Medida;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Producto_Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ServiciosController extends Controller
{
  /**
   * Función index()
   * Retorna la vista 'index' de servicios donde se enlistan
   * los productos y/o servicios registrados
   */
  public function index(){
    $usuario = [];
    array_push($usuario, ['name' => Auth::user()->name, 'NombreRol' => Auth::user()->rol->nombre_rol]);
    
    $productosServicios = Producto_Servicio::withTrashed()->get();

    return view('system.servicios.index', [
      'user' => $usuario,
      'productosServicios' => $productosServicios,
    ]);
  }

  /**
   * Función showRegisterServicio()
   * Consulta las tablas de tipo y unidad de medida
   * los retorna a la vista 'register' de servicios
   * donde se muestra formulario para registrar un nuevo producto y/o servicio
   */
  public function showRegisterServicio(){
    $tiposProductoServicio = Tipo_Producto_Servicio::all();
    $unidadesDeMedida = Unidad_De_Medida::all();

    return view('system.servicios.register',[
      "tipos" => $tiposProductoServicio,
      "unidades" => $unidadesDeMedida,
    ]);
  }

  /**
   * Función registerServicio()
   * hace las validaciones de los campos para registrar un producto y/o sevricio
   * si las validaciones son correctas, se hace la alta del registro
   * hace el redireccionamiento a la ruta 'showServicios'
   */
  public function registerServicio(Request $request){
    // dd($request);
    $request->validate([
      // 'nombre' => 'required|unique:productos_servicios,nombre|min:1|max:100',
      'nombre' => 'required|min:1|max:100',
      'descripcion' => 'required|min:1|max:255',
      'codigo' => 'required|min:1|max:45',
      'imagen' => 'image|mimes:gif,jpeg,png,svg',
      'precio' => 'required',
      'tipo' => 'required',
      'unidad' => 'required',
    ]);
    // Se prepara la imágen para ser almacenada dentro de la carpeta 'images > productos_servicios/'
    $file = $request->file('imagen'); // Se obtiene la imagen
    if($file!= ""){ // Si la imagen es diferente de vacio
        $imgDestination = 'images/productos_servicios/';
        $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
        $img2 = time(). '-' . $img; // Se concatena el nombre de la imagen
        $request->file('imagen')->move($imgDestination, $img2);
    }else{
        $img2 = 'sinImagen.svg';
    }

    $producto_servicio = [
      'nombre' => $request->nombre,
      'descripcion' => $request->descripcion,
      'codigo' => $request->codigo,
      'imagen' => $img2,
      'precio_bruto' => $request->precio,
      'tipo_id' => $request->tipo,
      'unidad_medida_id' => $request->unidad,
    ];

    Producto_Servicio::create($producto_servicio);

    return redirect()->route('tenant.showServicios');
  }

  /**
   * Función showEditServicio()
   * Consulta las tablas de tipo y unidad de medida
   * Busca el producto y/o servicio que se quiere editar
   * retorna todo a la vista 'edit' de servicios
   * donde se muestra el formulario para editar el registro
   */
  public function showEditServicio($servicio){
    $tiposProductoServicio = Tipo_Producto_Servicio::all();
    $unidadesDeMedida = Unidad_De_Medida::all();
    
    $servicioFind = Producto_Servicio::withTrashed()->find($servicio);
    
    return view('system.servicios.edit',[
      'tipos' => $tiposProductoServicio,
      'unidades' => $unidadesDeMedida,
      'servicio' => $servicioFind,
    ]);
  }

  /**
   * Función editServicio()
   * hace las validaciones de los campos editados en el producto y/o servicio
   * si las validaciones son correctas, se hace la actualización del registro
   * hace el redireccionamiento a la ruta 'showServicios'
   */
  public function editServicio(Request $request, $servicioID){
    $request->validate([
      'nombre' => 'required|min:1|max:100',
      'descripcion' => 'required|min:1|max:255',
      'codigo' => 'required|min:1|max:45',
      'imagen' => 'image|mimes:gif,jpeg,png,svg',
      'precio' => 'required',
      'tipo' => 'required',
      'unidad' => 'required',
    ]);

    $servicio = Producto_Servicio::withTrashed()->find($servicioID);

    // Se prepara la imágen para ser almacenada dentro de la carpeta 'images > productos_servicios/'
    $file = $request->file('imagen'); // Se obtiene la imagen
    if($file){ // Si la imagen fue cambiada
        $imgDestination = 'images/productos_servicios/';
        $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
        $img2 = time(). '-' . $img; // Se concatena el nombre de la imagen
        $request->file('imagen')->move($imgDestination, $img2);
        $servicio->imagen = $img2;
    }

    $servicio->nombre = $request->nombre;
    $servicio->descripcion = $request->descripcion;
    $servicio->codigo = $request->codigo;
    $servicio->precio_bruto = $request->precio;
    $servicio->tipo_id = $request->tipo;
    $servicio->unidad_medida_id = $request->unidad;
    $servicio->update();

    return redirect()->route("tenant.showServicios");
  }

  /**
   * Función deleteServicio()
   * obtiene el servicio que se quiere dar de baja
   * lo busca y hace la baja lógica
   * hace el redireccionamiento a la ruta 'showServicios'
   */
  public function deleteServicio($servicio_id){
    Producto_Servicio::withTrashed()->find($servicio_id)
                      ->delete();

    return redirect()->route('tenant.showServicios');
  }

  /**
   * Función activateServicio()
   * obtiene el servicio que se quiere volver a activar (quitar baja lógica)
   * lo busca y lo activa nuevamente
   * hace el redireccionamiento a la ruta 'showServicios'
   */
  public function activateServicio($servicio_id)
  {
    Producto_Servicio::withTrashed()
      ->find($servicio_id)
      ->restore();

    return redirect()->route('tenant.showServicios');
  }
}