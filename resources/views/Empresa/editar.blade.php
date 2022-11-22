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
  <form class="company-form" method="POST" action="{{ route('actualizarEmpresa', $empresa) }}">
    @method('put')
    @csrf

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

        <div class="register-double">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="estado">{{ __('Estado') }}</label>
              <select name="estado" id="estado" autofocus>
                <option selected disabled value="">Seleccione un estado</option>
                @foreach($estados as $estado)
                  @if ($estado->nombre  === $estadoEmpresa)
                    <option value="{{$estado->estado_id}}" selected>{{$estado->nombre}}</option>
                    @continue
                  @endif
                  <option value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                @endforeach
                @error('estado')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </select>
            </div>
          </div>
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="municipio">{{ __('Municipio') }}</label>
              <select name="municipio_id" id="municipio" autofocus>
                <option selected disabled value="">Seleccione un municipio</option>
                @foreach ($municipiosEmpresa as $municipioE)
                  @if ($municipioE->municipio_id === $municipioEmpresa->municipio_id)
                    <option selected value="{{$municipioE->municipio_id}}">{{ $municipioE->nombre }}</option>
                    @continue
                  @endif
                  <option value="{{$municipioE->municipio_id}}">{{ $municipioE->nombre }}</option>
                @endforeach
                @error('municipio_id')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </select>
            </div>
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

        @if ($empresa->imagen !== null)
          <div class="register-data register-image">
            <div class="data-body">
              <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="imagen">{{ __('Logotipo') }}</label>
              </div>
            </div>
            <div class="service-image">
              <img src="{{asset("images/logotipos/$empresa->imagen")}}" alt="Logo de la empresa" id="img_servicio" width="250">
            </div>
          </div>
        @endif
      </div>
    </div>

    <div class="company-fSecond">
      <p class="form-concept">Información de la persona encargada (Administrador)</p>
      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="email">{{ __('Correo electrónico') }}</label>
            {{-- <input readonly id="email" type="email" name="email" value="{{ old('email', $empresa->correo_electronico) }}" autocomplete="email" placeholder="julian@compushop.com"> --}}
            <p class="read-only">{{$empresa->correo_electronico}}</p>
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nameContact">{{ __('Nombre de Contacto') }}</label>
            <input id="nameContact" type="text" name="nameContact" value="{{ old('nameContact', $empresa->nombre_contacto) }}" autocomplete="nameContact" autofocus placeholder="Julian">

            @error('nameContact')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-double">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="apep">{{ __('Apellido paterno') }}</label>
              <input id="apep" type="text" name="apep" value="{{ old('apep', $empresa->apellido_p) }}" autocomplete="apep" autofocus placeholder="Hernández">

              @error('apep')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="apem">{{ __('Apellido materno') }}</label>
              <input id="apem" type="text" name="apem" value="{{ old('apem', $empresa->apellido_m) }}" autocomplete="apem" autofocus placeholder="Díaz">

              @error('apem')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-phone.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="phone">{{ __('Teléfono') }}</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', $empresa->telefono) }}" autocomplete="phone" autofocus placeholder="7225678564">

            @error('phone')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

      </div>
    </div>
    <button class="form-cta" type="submit">{{ __('Actualizar') }}</button>
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

  window.onload = function exampleFunction() {
    
    $estadoSelect = document.getElementById("estado");
    $municipiosSelect = document.getElementById("municipio");
    $estadoSelect.addEventListener('change', ()=> {
      $municipiosSelect.innerHTML = "";
      let estadoID = $estadoSelect.selectedIndex;
      const municipios = @json($municipios);
      municipios.forEach((mun) => {
        if(mun.estado_id === estadoID){
          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          $municipiosSelect.appendChild(option);
        }
      });
    });
  }
</script>