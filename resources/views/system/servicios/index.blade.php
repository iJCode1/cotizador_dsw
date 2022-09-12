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
              <td>{{$servicio->tipo->nombre_tipo}}</td>
              <td>{{Str::ucfirst($servicio->unidad->nombre_unidad)}}</td>
              <td>
                <a href="{{ route('tenant.showEditServicio', $servicio) }}" class="btn btn-warning">Editar</a>
              </td>
              <td>
                @if ($servicio->deleted_at != NULL)
                  <form id="activateForm" action="{{ route('tenant.activateServicio', ['servicio_id' => $servicio->producto_servicio_id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-info text-white">Activar</button>
                  </form>
                @else
                  <form id="deleteForm" action="{{ Route('tenant.deleteServicio', ['servicio_id' => $servicio->producto_servicio_id]) }}">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    @endif

    <a href="{{route('tenant.showRegisterServicio')}}" class="btn btn-block btn-primary my-4">Crear Producto y/o Servicio</a>
  </div>

  {{-- Script para mostrar alertas --}}
  <script>

    const d = document;

    // Alerta al querer eliminar un registro
    const deleteForms = d.querySelectorAll('#deleteForm');

    deleteForms.forEach(form => {
      form.addEventListener('click', function(event){
        event.preventDefault();
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Se eliminara este producto y/o servicio",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Si, eliminar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })
      })
    });

    // Alerta al querer activar un registro
    const activateforms = d.querySelectorAll('#activateForm');

    activateforms.forEach(form => {
      form.addEventListener('click', function(event){
        event.preventDefault();
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Se activara este producto y/o servicio",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Si, activar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })
      })
    });

  </script>

  {{-- Condicional para mostrar alerta de producto y/o servicio creado --}}
  @if (session('crear') === 'ok'){
    <script>
      Swal.fire(
        'Registrado!',
        'El producto y/o servicio se ha registrado con éxtio!',
        'success'
      )
    </script>
  } 
  @endif

  {{-- Condicional para mostrar alerta de editado --}}
  @if (session('editar') === 'ok'){
    <script>
      Swal.fire(
        'Editado!',
        'El producto y/o servicio se ha editado correctamente!',
        'success'
      )
    </script>
  } 
  @endif

  {{-- Condicional para mostrar alerta de eliminado --}}
  @if (session('eliminar') === 'ok'){
    <script>
      Swal.fire(
        'Eliminado!',
        'El producto y/o servicio se ha eliminado con éxito!',
        'success'
      )
    </script>
  } 
  @endif

  {{-- Condicional para mostrar alerta de activado --}}
  @if (session('activar') === 'ok'){
    <script>
      Swal.fire(
        'Activado!',
        'El producto y/o servicio se ha activado con éxito!',
        'success'
      )
    </script>
  } 
  @endif
@endsection()