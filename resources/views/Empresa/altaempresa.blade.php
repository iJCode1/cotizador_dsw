@extends('layouts.app')

@section('title')
  <title>Registrar Empresa</title>
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
      <h2>Registrar nueva empresa</h2>
    </div>
  </div>
  <form class="company-form" method="POST" action="{{ route('registrarEmpresa') }}" enctype="multipart/form-data">
    @csrf

    <div class="company-fFirst">
      <p class="form-concept">Información de la empresa</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-company_black.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="fqdn">{{ __('Nombre de la Empresa') }}</label>
            <input id="fqdn" type="text" name="fqdn" value="{{ old('fqdn') }}" autocomplete="fqdn" placeholder="CompuShop">

            @error('fqdn')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="address">{{ __('Dirección de la empresa') }}</label>
            <input id="address" type="text" name="address" value="{{ old('address') }}" autocomplete="address" autofocus placeholder="Lago azul, #56, Int. #6 Col, Hornex, 67870 CDMX">

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
            <input id="postal" type="number" name="postal" value="{{ old('postal') }}" autocomplete="postal" autofocus placeholder="67453">
            
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
                  @if (old('estado') == $estado->estado_id)
                    <option selected value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                    @continue
                  @endif
                  <option value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                @endforeach
                
                @error('estado')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </select>

              @error('estado')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="municipio">{{ __('Municipio') }}</label>
              <select name="municipio_id" id="municipio" autofocus>
                <option selected disabled value="">Seleccione un municipio</option>
              </select>

              @error('municipio_id')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-rfc.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="rfc">{{ __('RFC') }}</label>
            <input id="rfc" type="text" name="rfc" value="{{ old('rfc') }}" autocomplete="number" autofocus placeholder="5645342343423">

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
            <input id="imagen" type="file" name="imagen" value="{{ old('imagen') }}" autofocus onchange="vistaPreliminar(event)">

          </div>
        </div>

        <div class="company-image company-none" id="company-image">
          <img src="{{asset('images/productos_servicios/sinImagen.svg')}}" alt="" id="img_company" width="250">
        </div>

      </div>
    </div>

    <div class="company-fSecond">
      <p class="form-concept">Información de la persona encargada (Administrador)</p>
      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nameContact">{{ __('Nombre de Contacto') }}</label>
            <input id="nameContact" type="text" name="nameContact" value="{{ old('nameContact') }}" autocomplete="nameContact" autofocus placeholder="Julian">

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
              <input id="apep" type="text" name="apep" value="{{ old('apep') }}" autocomplete="apep" autofocus placeholder="Hernández">

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
              <input id="apem" type="text" name="apem" value="{{ old('apem') }}" autocomplete="apem" autofocus placeholder="Díaz">

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
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus placeholder="7225678564">

            @error('phone')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="email">{{ __('Correo electrónico') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="julian@compushop.com">
            
            @error('email')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-password.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="password">{{ __('Contraseña') }}</label>
            <input id="password" type="password" name="password" value="{{ old('password') }}" autocomplete="off" placeholder="**********">

            @error('password')
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

<script>

  function vistaPreliminar(event){
    let img = new FileReader();
    let img_id = document.getElementById('img_company');
    img.onload = () => {
      if(img.readyState == 2){
        img_id.src = img.result;
        $("#company-image").removeClass('company-none')
      }
    }
      img.readAsDataURL(event.target.files[0]);
  }

  window.onload = function mostrarOptions() {
    
    $estadoSelect = document.getElementById("estado");
    $municipiosSelect = document.getElementById("municipio");
    const municipios = @json($municipios);
    let estadoID;

    $estadoSelect.addEventListener('change', ()=> {
      $municipiosSelect.innerHTML = "";
      estadoID = $estadoSelect.selectedIndex

      municipios.forEach((mun) => {
        if(mun.estado_id === estadoID){
          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          $municipiosSelect.appendChild(option);
        }
      });
    });


    

    if(@json(old('municipio_id'))){
      let municipioOld = 0;
      let estado_id = 0;
      municipioOld = @json(old('municipio_id'));

      municipios.forEach((mun) => {
        if(mun.municipio_id == municipioOld){
          estado_id = mun.estado_id
        }
      });

      municipios.forEach((mun) => {
        if(mun.estado_id == estado_id){

          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          if(municipioOld == mun.municipio_id){
            option.setAttribute("selected", true);
          }
          $municipiosSelect.appendChild(option);
        }
      });
    }

  }

</script>