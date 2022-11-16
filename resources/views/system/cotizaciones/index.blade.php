@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/cotizaciones.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- <div class="container">
  @if ( count($cotizaciones) <= 0 )
    <p>No hay Cotizaciones</p>
    <img src="{{asset('images/illustrations/emptyQuotes.svg')}}" alt="Empty Quotes" width="300">
  @else
    <p>Si hay Cotizaciones</p>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Folio Cotización</th>
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
          <td>{{$cotizacion->folio_cotizacion}}</td>
          <td>{{$cotizacion->descripcion}}</td>
          <td>{{$cotizacion->fecha_creacion}}</td>
          <td>{{$cotizacion->vigencia}}</td>
          <td>{{$cotizacion->estatus_cotizacion_id}}</td>
          <td>{{$cotizacion->user->nombre}}</td>
          <td>{{$cotizacion->cliente->nombre}}</td>
          <td>
            <a href="{{ route('tenant.showCotizacionEditForm', $cotizacion) }}" class="btn btn-warning">Editar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$cotizaciones->links()}}
  @endif
  <a href="{{route('tenant.cotizacion')}}" class="btn btn-block btn-primary my-4">Crear Nueva Cotización</a>
</div> --}}
<div class="quotation">
  <div class="quotation-first">
    <div class="quotation-title">
      <img src="{{ asset('images/icons/icon-cotizaciones_black.svg') }}" class="nav-icon" alt="Icono de cotizaciones" title="Icono de cotizaciones" width="24">
      <h2>{{ __('Cotizaciones') }}</h2>
    </div>
    <a href="{{ route('tenant.cotizacion') }}" class="quotation-button">
      <span>+</span>
      <span>Nueva cotización</span>
    </a>
  </div>
  @if (count($cotizaciones) <= 0)
    <div class="quotation-second">
      <img src="{{ asset('images/illustrations/empresas.svg') }}" alt="Empresas" title="No hay empresas registradas" width="250">
      <p>No se han realizado cotizaciones</p>
    </div>
  @else

  @endif
  
</div>

@if (session('crear') === 'ok')
  <script>
    Swal.fire(
      'Registrado!',
      '¡La cotización se ha realizado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('editar') === 'ok')
  <script>
    Swal.fire(
      'Editado!',
      '¡La cotización se ha editado correctamente!',
      'success'
    )
  </script>
@endif

@endsection