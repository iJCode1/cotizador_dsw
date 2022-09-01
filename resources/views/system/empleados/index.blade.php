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
          {{-- <th scope="col">Contraseña</th> --}}
          {{-- <th scope="col">Rol</th> --}}
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
            {{-- <a href="{{ route('editarEmpresa', $empresa) }}" class="btn btn-warning">Editar</a> --}}
            <a href="#" class="btn btn-warning">Editar</a>
          </td>
          <td>
            {{-- <a href="{{ route('desactivarEmpresa', ['id' => $empresa->empresa_id]) }}" class="btn btn-danger">Eliminar</a> --}}
            @if ($usuario->deleted_at != NULL)
              <a href="{{ route('tenant.activateUser', ['usuario_id' => $usuario->usuario_id]) }}">
                <button type="button" class="btn btn-info text-white">Activar</button>
              </a>
            @else
              <a href="{{ Route('tenant.deleteUser', ['usuario_id' => $usuario->usuario_id]) }}">
                <button type="button" class="btn btn-danger">Eliminar</button>
              </a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>

@endsection()