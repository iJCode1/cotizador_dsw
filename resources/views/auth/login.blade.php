@extends('layouts.login')

@section('css')
  <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="login-container">
  <div class="login-first">
    <h2 class="login-title">¡Bienvenido!</h2>
    <img class="login-image" src="{{ asset('images/illustrations/loginAdmin.svg') }}" alt="" width="290">
    <div class="login-wave"></div>
  </div>
  <div class="login-second">
    <h2 class="second-title">Ingresa a tu cuenta</h2>
    @isset($url)
      <form class="login-form" method="POST" action="{{ route('tenant.login') }}" aria-label="{{ __('Login') }}">
    @else
      <form class="login-form" method="POST" action='{{ url("login/admin") }}' aria-label="{{ __('Login') }}">
    @endisset
      @csrf
      <div class="login-email">
        <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="32">
        <div class="login-input">
          <label for="email">{{ __('Correo electrónico') }}</label>
          <input id="email" type="email" placeholder="example@email.com" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="login-password">
        <img src="{{ asset('images/icons/icon-password.svg') }}" alt="" width="32">
        <div class="login-input">
          <label for="password">Contraseña</label>
          <input id="password" type="password" placeholder="**********" name="password" autocomplete="current-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <button class="login-cta" type="submit">{{ __('Ingresar') }}</button>
    </form>
    @isset($url)
      <span class="login-line"></span>
      <p class="login-link">
        ¿No tienes cuenta? <a href="{{ route('tenant.register') }}">{{ __('Registrarse') }}</a>
      </p>
    @endisset
  </div>
</div>

{{-- Condicional para mostrar alerta de empleado creado --}}
@if (session('cliente') === 'ok'){
  <script>
    Swal.fire(
      'Registrado!',
      'Te has registrado con éxtio!',
      'success'
    )
  </script>
} 
@endif

@endsection