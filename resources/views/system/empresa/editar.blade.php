@extends('layouts.app')

@section('title')
  <title>Editar Empresa</title>
@endsection

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
  <form class="company-form" method="POST" action="{{ route('tenant.actualizarEmpresa', $empresa) }}" enctype="multipart/form-data">
    @method('put')
    @csrf

    <div class="company-fFirst">
      <p class="form-concept">Información de la empresa</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-globe_black.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="fqdn">{{ __('Dominio') }}</label>
            <p class="read-only">{{$empresa->fqdn}}</p>
          </div>
        </div>
        
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="address">{{ __('Dirección de la empresa') }}</label>
            <input id="address" type="text" name="address" value="{{ old('address', $empresa->direccion) }}" autocomplete="address" autofocus placeholder="Lago azul, #56, Int. #6 Col, Hornex, 67870 CDMX">

            @error('address')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="postal">{{ __('Código postal') }}</label>
            <input id="postal" type="number" name="postal" value="{{ old('postal', $empresa->codigo_postal) }}" autocomplete="postal" autofocus placeholder="67453">
            
            @error('postal')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-rfc.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="rfc">{{ __('RFC') }}</label>
            <input id="rfc" type="text" name="rfc" value="{{ old('rfc', $empresa->rfc) }}" autocomplete="number" autofocus placeholder="5645342343423">

            @error('rfc')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
          <div class="register-input company-file">
            <label for="imagen">{{ __('Logotipo') }}</label>
            <input id="imagen" type="file" name="imagen" value="{{ $empresa->imagen }}" autofocus onchange="vistaPreliminar(event)">

            @error('imagen')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="service-image">
          <img src="{{asset("images/logotipos/$empresa->imagen")}}" alt="" id="img_servicio" width="250">
        </div>

      </div>
    </div>
    <button class="form-cta cta-edit" type="submit">{{ __('Editar') }}</button>
  </form>
</div>
@endsection

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