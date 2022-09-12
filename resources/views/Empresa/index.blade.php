@extends('layouts.app')

@section('content')

  <div class="container">
    <h1 class="text-center mt-2 mb-4">Home de la Empresa</h1>
    @if (count($empresas) <= 0)
        <p>No hay empresas</p>
        <img src="{{asset('images/illustrations/not_found.svg')}}" alt="No hay empresas" width="300">
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
                <form id="deleteForm" action="{{ route('desactivarEmpresa', ['id' => $empresa->empresa_id]) }}">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    @endif
    <a href="{{route('altaEmpresa')}}" class="btn btn-block btn-primary my-4">Crear Empresa</a>
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
          text: "Se eliminara esta empresa",
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
          text: "Se activara esta empresa",
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
        'La empresa se ha registrado con éxtio!',
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
        'La empresa se ha editado correctamente!',
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
        'La empresa se ha eliminado con éxito!',
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
        'La empresa se ha activado con éxito!',
        'success'
      )
    </script>
  } 
  @endif
@endsection