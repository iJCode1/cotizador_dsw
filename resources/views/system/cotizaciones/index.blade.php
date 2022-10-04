@extends('layouts.app')

@section('content')
<div class="container">
  @if ( count($cotizaciones) <= 0 )
    <p>No hay Cotizaciones</p>
    <img src="{{asset('images/illustrations/emptyQuotes.svg')}}" alt="Empty Quotes" width="300">
    @else
    <p>Si hay Cotizaciones</p>
  @endif
  <a href="{{route('tenant.cotizacion')}}" class="btn btn-block btn-primary my-4">Crear Nueva Cotización</a>
</div>
@endsection