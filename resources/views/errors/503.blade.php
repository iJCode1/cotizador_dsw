@extends('errors::error')

@section('css')
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('image')
  <img class="error-image" src="{{ asset('images/illustrations/error-50x.svg') }}" alt="Ilustración de error 404" width="250">
@endsection

@section('title', __('Servicio no disponible'))

@section('message')
  <p class="error-message">503: Servicio no disponible</p>
@endsection