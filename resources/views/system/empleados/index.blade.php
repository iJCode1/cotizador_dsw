@extends('layouts.app')

@section('content')

  <div class="container">
    @if (count($usuarios) <= 0)
      <p>No hay Usuarios</p>
    @else
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido Paterno</th>
          <th scope="col">Apellido Materno</th>
          <th scope="col">Direccion</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo Electronico</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
          <th scope="row">{{$usuario->usuario_id}}</th>
          <td>{{$usuario->nombre}}</td>
          <td>{{$usuario->apellido_p}}</td>
          <td>{{$usuario->apellido_m}}</td>
          <td>{{$usuario->direccion}}</td>
          <td>{{$usuario->telefono}}</td>
          <td>{{$usuario->correo_electronico}}</td>
          <td>
            <a href=" {{ route('tenant.showEditUser', ['usuario_id' => $usuario->usuario_id]) }} ">
              <button type="button" class="btn btn-warning">Editar</button>
            </a>
          </td>
          <td>
            @if ($usuario->deleted_at != NULL)
            <form id="activateForm" action="{{ route('tenant.activateUser', ['usuario_id' => $usuario->usuario_id]) }}">
              @csrf
              <button type="submit" class="btn btn-info text-white">Activar</button>
            </form>
            @else
              <form id="deleteForm" action="{{ route('tenant.deleteUser', ['usuario_id' => $usuario->usuario_id]) }}">
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
    <a href="{{route('tenant.showRegister')}}" class="btn btn-block btn-primary mb-">Crear Usuario</a>
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
          text: "Se eliminara este empleado",
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
          text: "Se activara este empleado",
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

  {{-- Condicional para mostrar alerta de empleado creado --}}
  @if (session('crear') === 'ok'){
    <script>
      Swal.fire(
        'Registrado!',
        'El empleado se ha registrado con éxtio!',
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
        'El empleado se ha editado correctamente!',
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
        'El empleado se ha eliminado con éxito!',
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
        'El empleado se ha activado con éxito!',
        'success'
      )
    </script>
  } 
  @endif
@endsection()