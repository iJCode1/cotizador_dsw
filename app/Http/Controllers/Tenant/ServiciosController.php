<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant\User;
use App\Models\Tenant\Tipo_Producto_Servicio;
use App\Models\Tenant\Unidad_De_Medida;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Producto_Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ServiciosController extends Controller
{
  public function index(){
    $usuario = [];
    array_push($usuario, ['name' => Auth::user()->name, 'NombreRol' => Auth::user()->rol->nombre_rol]);
    
    $productosServicios = Producto_Servicio::all();

    return view('system.servicios.index', [
      'user' => $usuario,
      'productosServicios' => $productosServicios,
    ]);
  }

  public function showRegisterServicio(){
    $tiposProductoServicio = Tipo_Producto_Servicio::all();
    $unidadesDeMedida = Unidad_De_Medida::all();

    return view('system.servicios.register',[
      "tipos" => $tiposProductoServicio,
      "unidades" => $unidadesDeMedida,
    ]);
  }

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

  public function showEditServicio($servicio){
    $tiposProductoServicio = Tipo_Producto_Servicio::all();
    $unidadesDeMedida = Unidad_De_Medida::all();
    
    $servicioFind = Producto_Servicio::find($servicio);
    // dd($servicioFind);
    return view('system.servicios.edit',[
      'tipos' => $tiposProductoServicio,
      'unidades' => $unidadesDeMedida,
      'servicio' => $servicioFind,
    ]);
  }

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

    $servicio = Producto_Servicio::find($servicioID);

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
}
