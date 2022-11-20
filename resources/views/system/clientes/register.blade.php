@extends('layouts.login')

@section('title')
  <title>Registrarse</title>
@endsection

@section('css')
  <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="register-container">
  <div class="register-first">
    <h2 class="register-title">¡Registro!</h2>
    <img class="register-image" src="{{ asset('images/illustrations/register.svg') }}" alt="" width="290">
    <div class="register-wave"></div>
  </div>
  <div class="register-second">
    <h2 class="second-title">Ingresa los datos solicitados</h2>
    <form class="register-form" method="POST" action="{{ route('tenant.register') }}">
      @csrf

      <div class="register-name register-data">
        <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="nombre">{{ __('Nombre') }}</label>
          <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Julieta">

          @error('nombre')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-lastname1 register-data">
        <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="app">{{ __('Apellido paterno') }}</label>
          <input id="app" type="text" name="app" value="{{ old('app') }}" autocomplete="app" autofocus placeholder="Vega">

          @error('app')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-lastname2 register-data">
        <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="apm">{{ __('Apellido Materno') }}</label>
          <input id="apm" type="text" name="apm" value="{{ old('apm') }}" autocomplete="apm" autofocus placeholder="Álvarez">
          
          @error('apm')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-address register-data">
        <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="direccion">{{ __('Dirección') }}</label>
          <input id="direccion" type="text" name="direccion" value="{{ old('direccion') }}" autocomplete="direccion" autofocus placeholder="Calle del Sol #45, Col. 5 soles, Toluca, Edo. México">

          @error('direccion')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-phone register-data">
        <img src="{{ asset('images/icons/icon-phone.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="telefono">{{ __('Teléfono') }}</label>
          <input id="telefono" type="tel" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus placeholder="7226745674">
          
          @error('telefono')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-email register-data">
        <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="correo">{{ __('Correo electrónico') }}</label>
          <input id="correo" type="email" name="correo" value="{{ old('correo') }}" autocomplete="email" placeholder="example@email.com">

          @error('correo')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="register-password register-data">
        <img src="{{ asset('images/icons/icon-password.svg') }}" alt="" width="32">
        <div class="register-input">
          <label for="contraseña">{{ __('Contraseña') }}</label>
          <input id="contraseña" type="password" name="contraseña" autocomplete="password" placeholder="**********">

          @error('contraseña')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <button class="register-cta" type="submit">{{ __('Registrarse') }}</button>
    </form>
    <span class="register-line"></span>
    <p class="register-link">
      ¿Ya tienes cuenta? <a href="{{ route('tenant.login') }}">{{ __('Iniciar Sesión') }}</a>
    </p>
  </div>
</div>
@endsection
