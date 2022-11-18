@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/cotizaciones.css') }}" rel="stylesheet">
@endsection

@section('content')
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
  <div class="rtable">
    <div class="rtable-head">
      <p class="rtable-col rtable-id">ID</p>
      <p class="rtable-col rtable-folio">Folio</p>
      <p class="rtable-col rtable-description">Descripción</p>
      <p class="rtable-col rtable-validity">Vigencia</p>
      <p class="rtable-col rtable-employee">Generada por</p>
      <p class="rtable-col rtable-customer">Cliente</p>
      <p class="rtable-col rtable-actions">Acciones</p>
    </div>
    <div class="rtable-body">
      @foreach ($cotizaciones as $cotizacion)
        <div class="rtable-row">
          <p class="rtable-item rtable-id">{{$cotizacion->cotizacion_id}}</p>
          <p class="rtable-item rtable-folio">{{$cotizacion->folio_cotizacion}}</p>
          <p class="rtable-item rtable-description">{!! $cotizacion->descripcion !!}</p>
          <p class="rtable-item rtable-validity">{{$cotizacion->vigencia}} días</p>
          <p class="rtable-item rtable-employee">{{$cotizacion->user->nombre}}</p>
          <p class="rtable-item rtable-customer">{{$cotizacion->cliente->nombre}}</p>
          <div class="rtable-group rtable-actions">
            <a class="rtable-link" href="{{ route('tenant.showCotizacionEditForm', $cotizacion) }}">
              <img src="{{ asset('images/icons/icon-edit.svg') }}" class="rtable-icon" alt="Icono de editar" title="Editar" width="22">
              <span class="rtable-span">Editar</span>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
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