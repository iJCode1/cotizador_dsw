@extends('layouts.app')

@section('content')

  <div class="container">
    <h2>Home de la Empresa</h2>

    {{-- {{dd(count($empresas))}} --}}
    @if (count($empresas) <= 0)
        <p>No hay empresas</p>
    @else
        <p>Si hay empresas</p>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Dirección</th>
              <th scope="col">CP</th>
              <th scope="col">Numero</th>
              <th scope="col">Estado</th>
              <th scope="col">Municipio</th>
              <th scope="col">RFC</th>
              <th scope="col">Nombre Contacto</th>
              <th scope="col">Telefono</th>
              <th scope="col">Hostname</th>
              <th scope="col">Usuario</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($empresas as $empresa)   
            <tr>
              <th scope="row">{{$empresa->empresa_id}}</th>
              <td>{{$empresa->direccion}}</td>
              <td>{{$empresa->codigo_postal}}</td>
              <td>{{$empresa->numero}}</td>
              @foreach ($municipios as $municipio)
                @if ($municipio->municipio_id === $empresa->municipio_id)
                  @foreach ($estados as $estado)
                    @if ($estado->estado_id === $municipio->estado_id)
                      <td>{{$estado->nombre}}</td>
                    @endif
                  @endforeach
                @endif
              @endforeach
              @foreach ($municipios as $municipio)
                @if ($municipio->municipio_id === $empresa->municipio_id)  
                  <td>{{$municipio->nombre}}</td>
                @endif
              @endforeach
              <td>{{$empresa->rfc}}</td>
              <td>{{$empresa->nombre_contacto}}</td>
              <td>{{$empresa->telefono}}</td>
              @foreach ($hostnames as $hostname)
                @if ($hostname->id === $empresa->hostname_id)
                  <td>{{$hostname->fqdn}}</td>
                @endif
              @endforeach
              @foreach ($users as $usuario)
                @if ($usuario->id === $empresa->usuario_id)
                  <td>{{$usuario->name}}</td>
                @endif
              @endforeach
              {{-- {{dd($empresa)}} --}}
              <td>
                <a href="{{ route('editarEmpresa', $empresa) }}" class="btn btn-warning">Editar</a>
              </td>
              <td>
                <a href="{{ route('desactivarEmpresa', ['id' => $empresa->empresa_id]) }}" class="btn btn-danger">Eliminar</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    @endif
  </div>

@endsection