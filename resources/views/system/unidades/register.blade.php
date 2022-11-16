@extends('layouts.app')

@section('content')
<div class="service">
  <div class="service-first service-concept">
    <div class="service-title">
      <img src="{{ asset('images/icons/icon-unidad.svg') }}" class="nav-icon" alt="Icono de unidades de medida" title="Icono de unidades de medida" width="24">
      <h2>{{ __('Registrar Unidad de Medida') }}</h2>
    </div>
  </div>
  <form class="service-form" method="POST" action="{{ route('tenant.registerUnidad') }}">
    @csrf
    @method('post')

    <div class="service-fFirst">
      <p class="form-concept">Información de la unidad</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-label.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nombre">{{ __('Nombre de la unidad') }}</label>
            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="unidad">

            @error('nombre')
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
            <input id="abrev" type="text" name="abrev" value="{{ old('abrev') }}" autocomplete="abrev" autofocus placeholder="un">

            @error('abrev')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

      </div>
    </div>
    <button class="form-cta" type="submit">{{ __('Registrar') }}</button>
  </form>
</div>

@endsection