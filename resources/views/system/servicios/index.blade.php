@extends('layouts.app')

@section('content')

  <div class="container">
    <h1 class="text-center mt-2 mb-4">Productos y/o Servicios</h1>
    @if (count($productosServicios) <= 0)
        <p>No hay Productos y/o Servicios</p>
        <img src="{{asset('images/illustrations/empty.svg')}}" alt="No hay Productos y/o Servicios" width="300">
    @else
        <p>Si hay Productos y/o Servicios</p>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Descripción</th>
              <th scope="col">Código</th>
              <th scope="col">Imagen</th>
              <th scope="col">Precio bruto</th>
              <th scope="col">Tipo</th>
              <th scope="col">Unidad de Medida</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($productosServicios as $servicio)   
            <tr>
              <th scope="row">{{$servicio->producto_servicio_id}}</th>
              <td>{{$servicio->nombre}}</td>
              <td>{{$servicio->descripcion}}</td>
              <td>{{$servicio->codigo}}</td>
              <td>{{$servicio->imagen}}</td>
              <td>{{$servicio->precio_bruto}}</td>
              <td>{{$servicio->tipo_id}}</td>
              <td>{{$servicio->unidad_medida_id}}</td>
              <td>
                <a href="{{ route('tenant.showEditServicio', $servicio) }}" class="btn btn-warning">Editar</a>
              </td>
              <td>
                <a href="{{ route('tenant.deleteServicio', ['servicio_id' => $servicio->producto_servicio_id]) }}" class="btn btn-danger">Eliminar</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    @endif

    <a href="{{route('tenant.showRegisterServicio')}}" class="btn btn-block btn-primary my-4">Crear Producto y/o Servicio</a>
  </div>

@endsection()