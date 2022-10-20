@extends('layouts.app')

@section('content')
<div class="container">
  @if ( count($cotizaciones) <= 0 )
    <p>No hay Cotizaciones</p>
    <img src="{{asset('images/illustrations/emptyQuotes.svg')}}" alt="Empty Quotes" width="300">
  @else
    <p>Si hay Cotizaciones</p>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre Cotización</th>
          <th scope="col">Descripción</th>
          <th scope="col">Fecha Creación</th>
          <th scope="col">Vigencia</th>
          <th scope="col">Estatus Cotización</th>
          <th scope="col">Usuario</th>
          <th scope="col">Cliente</th>
          <th scope="col">Editar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cotizaciones as $cotizacion)
        <tr>
          <th scope="row">{{$cotizacion->cotizacion_id}}</th>
          <td>{{$cotizacion->nombre_cotizacion}}</td>
          <td>{{$cotizacion->descripcion}}</td>
          <td>{{$cotizacion->fecha_creacion}}</td>
          <td>{{$cotizacion->vigencia}}</td>
          <td>{{$cotizacion->estatus_cotizacion_id}}</td>
          <td>{{$cotizacion->user->nombre}}</td>
          <td>{{$cotizacion->cliente->nombre}}</td>
          <td>
            <a href="{{ route('tenant.showCotizacionEditForm', $cotizacion) }}" class="btn btn-warning">Editar</a>
          </td>
          {{-- @foreach ($websites as $website)
            @if ($empresa->hostname->website_id === $website->id)
            <td>
              @if ($website->deleted_at != NULL)
                <form id="activateForm" action="{{ route('activateEmpresa', ['id' => $website->id]) }}">
                  @csrf
                  <button type="submit" class="btn btn-info text-white">Activar</button>
                </form>
              @else
                <form id="deleteForm" action="{{ Route('desactivarEmpresa', ['id' => $website->id]) }}">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              @endif
            </td>
            @endif
          @endforeach --}}
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
  <a href="{{route('tenant.cotizacion')}}" class="btn btn-block btn-primary my-4">Crear Nueva Cotización</a>
</div>

{{-- Condicional para mostrar alerta de cotización realizada --}}
@if (session('crear') === 'ok'){
  <script>
    Swal.fire(
      'Registrado!',
      'La cotización se ha realizado con éxtio!',
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
      'La cotización se ha editado correctamente!',
      'success'
    )
  </script>
} 
@endif
@endsection