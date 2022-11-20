@extends('layouts.app')

@section('title')
  <title>Producto y/o Servicio</title>
@endsection

@section('css')
  <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="service">
  <div class="service-first service-concept">
    <div class="service-title">
      <img src="{{ asset('images/icons/icon-servicios_black.svg') }}" class="nav-icon" alt="Icono de servicios" title="Icono de servicios" width="24">
      <h2>{{ __('Producto y/o Servicio') }}</h2>
    </div>
  </div>
  <div class="service-fFirst">
    <p class="form-concept">Información del producto y/o servicio</p>

    <div class="form-inputs">
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-label.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="nombre">{{ __('Nombre del producto y/o servicio') }}</label>
          <p class="read-only">{{$servicio->nombre}}</p>

        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-descripcion.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="descripcion">{{ __('Descripción del producto y/o servicio') }}</label>
          <p class="read-only">{!! $servicio->descripcion !!}</p>

        </div>
      </div>
      
      <div class="register-double">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-price.svg') }}" alt="" width="28">
          <div class="register-input">
            <label for="precio">{{ __('Precio bruto') }}</label>
            <p class="read-only">${{$servicio->precio_bruto}}</p>

          </div>
        </div>
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="codigo">{{ __('Código') }}</label>
            <p class="read-only">{{$servicio->codigo}}</p>

          </div>
        </div>
      </div>

      <div class="register-double">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-unidad.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="unidad">{{ __('Unidad de medida') }}</label>
            <p class="read-only">{{$servicio->unidad->nombre_unidad}}</p>

          </div>
        </div>
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-tipo.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="tipo">{{ __('Tipo (Producto o Servicio)') }}</label>
            <p class="read-only">{{$servicio->tipo->nombre_tipo}}</p>

            </select>   
          </div>
        </div>
      </div>

      <div class="register-data register-image">
        <div class="data-body">
          <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="imagen">{{ __('Imagen') }}</label>
          </div>
        </div>
        <div class="service-image">
          <img src="{{asset("images/productos_servicios/$servicio->imagen")}}" alt="Imagen del producto y/o servicio" id="img_servicio" width="250">
        </div>
      </div>
      

    </div>
  </div>
  <a class="form-cta cta-show" href="{{ route('tenant.showServicios') }}">
    <span class="rtable-span">Regresar</span>
  </a>
</div>

<script>
function vistaPreliminar(event){
  let img = new FileReader();
  let img_id = document.getElementById('img_servicio');

  img.onload = () => {
    if(img.readyState == 2){
      img_id.src = img.result;
    }
  }

  img.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
