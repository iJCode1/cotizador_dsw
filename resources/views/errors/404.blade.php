@extends('errors::error')

@section('css')
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('image')
  <img class="error-image" src="{{ asset('images/illustrations/error-404.svg') }}" alt="Ilustración de error 404" width="250">
@endsection

@section('title', __('Página no encontrada'))

@section('message')
  <p class="error-message">Página no encontrada</p>
@endsection
