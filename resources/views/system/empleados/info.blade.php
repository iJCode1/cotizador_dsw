@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/empleados.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="employees">
  <div class="employees-first">
    <div class="employees-title">
      <img src="{{ asset('images/icons/icon-empleados_black.svg') }}" class="nav-icon" alt="Icono de empleado" title="Icono de empleado" width="24">
      <h2>{{ __('Empleado') }}</h2>
    </div>
  </div>
  <div class="employees-fFirst">
    <p class="form-concept">Información del Empleado</p>

    <div class="form-inputs">

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="nombre">{{ __('Nombre del empleado') }}</label>
          <p class="read-only">{{$usuarioFind->nombre}}</p>
          
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="app">{{ __('Apellido paterno') }}</label>
          <p class="read-only">{{$usuarioFind->apellido_p}}</p>

        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="apm">{{ __('Apellido materno') }}</label>
          <p class="read-only">{{$usuarioFind->apellido_m}}</p>

        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-map_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="direccion">{{ __('Dirección') }}</label>
          <p class="read-only">{{$usuarioFind->direccion}}</p>

        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-phone_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="telefono">{{ __('Teléfono') }}</label>
          <p class="read-only">{{$usuarioFind->telefono}}</p>

        </div>
      </div>
      
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-tipo_user_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="rol">{{ __('Tipo de usuario') }}</label>
          <p class="read-only">{{$usuarioFind->rol->nombre_rol}}</p>
          
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="correo">{{ __('Correo electrónico') }}</label>
          <p class="read-only">{{$usuarioFind->email}}</p>
          
        </div>
      </div>

    </div>
  </div>
  <a class="form-cta cta-show" href="{{ route('tenant.showEmpleados') }}">
    <span class="rtable-span">Regresar</span>
  </a>
</div>
@endsection