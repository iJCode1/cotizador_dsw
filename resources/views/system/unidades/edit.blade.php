@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/unidades.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="unit">
  <div class="unit-first unit-concept">
    <div class="unit-title">
      <img src="{{ asset('images/icons/icon-unidad.svg') }}" class="nav-icon" alt="Icono de unidades de medida" title="Icono de unidades de medida" width="24">
      <h2>{{ __('Editar Unidad de Medida') }}</h2>
    </div>
  </div>
  <form class="unit-form" method="POST" action="{{ route('tenant.editUnidad', $unidad) }}">
    @csrf
    @method('put')

    <div class="unit-fFirst">
      <p class="form-concept">Información de la unidad</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-label.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nombre_unidad">{{ __('Nombre de la unidad') }}</label>
            <input id="nombre_unidad" type="text" name="nombre_unidad" value="{{ old('nombre_unidad', $unidad->nombre_unidad) }}" autocomplete="nombre_unidad" autofocus placeholder="unidad">

            @error('nombre_unidad')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-unidad.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="abrev">{{ __('Abreviación') }}</label>
            <input id="abrev" type="text" name="abrev" value="{{ old('abrev', $unidad->abrev) }}" autocomplete="abrev" autofocus placeholder="un">

            @error('abrev')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

      </div>
    </div>
    <button class="form-cta" type="submit">{{ __('Editar') }}</button>
  </form>
</div>

@endsection