@extends('errors::error')

@section('css')
  <link href="{{ asset('css/error.css') }}" rel="stylesheet">
@endsection

@section('image')
  <img class="error-image" src="{{ asset('images/illustrations/error-40x.svg') }}" alt="Ilustración de error 404" width="250">
@endsection

@section('title', __('Sin acceso'))

@section('message')
  <p class="error-message">403: No tiene acceso a esta página</p>
@endsection