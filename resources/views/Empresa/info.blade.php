@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/empresas.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="company">
  <div class="company-first">
    <div class="company-title">
      <img src="{{ asset('images/icons/icon-empresas_black.svg') }}" class="nav-icon" alt="Icono de empresas" title="Icono de empresas" width="24">
      <h2>{{ __('Editar empresa') }}</h2>
    </div>
  </div>

  <div class="company-fFirst">
    <p class="form-concept">Información de la empresa</p>

    <div class="form-inputs">
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-globe_black.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="fqdn">{{ __('Dominio') }}</label>
          <p class="read-only">https://{{$fqdn}}.com</p>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="address">{{ __('Dirección de la empresa') }}</label>
          <p class="read-only">{{ $empresa->direccion }}</p>
          
        </div>
      </div>
      
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="postal">{{ __('Código postal') }}</label>
          <p class="read-only">{{ $empresa->codigo_postal }}</p>

        </div>
      </div>

      <div class="register-double">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="estado">{{ __('Estado') }}</label>
            @foreach($estados as $estado)
              @if ($estado->nombre  === $estadoEmpresa)
                <p class="read-only">{{ $estado->nombre }}</p>
                @continue
              @endif
            @endforeach

          </div>
        </div>
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="municipio">{{ __('Municipio') }}</label>
            @foreach ($municipiosEmpresa as $municipioE)
              @if ($municipioE->municipio_id === $municipioEmpresa->municipio_id)
                <p class="read-only">{{ $municipioE->nombre }}</p>
                @continue
              @endif
            @endforeach

          </div>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-rfc.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="rfc">{{ __('RFC') }}</label>
          <p class="read-only">{{ $empresa->rfc }}</p>
          
        </div>
      </div>

      @if ($empresa->imagen !== null)
        <div class="register-data register-image">
          <div class="data-body">
            <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="imagen">{{ __('Logotipo') }}</label>
            </div>
          </div>
          <div class="service-image">
            <img src="{{asset("images/productos_servicios/$empresa->imagen")}}" alt="Logo de la empresa" id="img_servicio" width="250">
          </div>
        </div>
      @endif
    </div>
  </div>

  <div class="company-fSecond company-info">
    <p class="form-concept">Información de la persona encargada (Administrador)</p>
    <div class="form-inputs">
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="email">{{ __('Correo electrónico') }}</label>
          <p class="read-only">{{$empresa->correo_electronico}}</p>

        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="nameContact">{{ __('Nombre de Contacto') }}</label>
          <p class="read-only">{{ $empresa->nombre_contacto }}</p>

        </div>
      </div>

      <div class="register-double">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="apep">{{ __('Apellido paterno') }}</label>
            <p class="read-only">{{ $empresa->apellido_p }}</p>

          </div>
        </div>
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="apem">{{ __('Apellido materno') }}</label>
            <p class="read-only">{{ $empresa->apellido_m }}</p>

          </div>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-phone.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="phone">{{ __('Teléfono') }}</label>
          <p class="read-only">{{ $empresa->telefono }}</p>

        </div>
      </div>
    </div>
  </div>
  <a class="form-cta cta-back" href="{{ route('empresas') }}">
    <span class="rtable-span">Regresar</span>
  </a>
</div>
@endsection