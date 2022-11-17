@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="service">
  <div class="service-first service-concept">
    <div class="service-title">
      <img src="{{ asset('images/icons/icon-servicios_black.svg') }}" class="nav-icon" alt="Icono de servicios" title="Icono de servicios" width="24">
      <h2>{{ __('Registrar Producto y/o Servicio') }}</h2>
    </div>
  </div>
  <form class="service-form" method="POST" action="{{ route('tenant.registerServicio') }}" enctype="multipart/form-data">
    @csrf
    @method('post')

    <div class="service-fFirst">
      <p class="form-concept">Información del producto y/o servicio</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-label.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nombre">{{ __('Nombre del producto y/o servicio') }}</label>
            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Página web informativa">

            @error('nombre')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-descripcion.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="descripcion">{{ __('Descripción del producto y/o servicio') }}</label>
            <textarea id="descripcion" name="descripcion" autofocus rows="2" placeholder="La página web cuenta con ...">{{ old('descripcion') }}</textarea>

            @error('descripcion')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        
        <div class="register-double">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-price.svg') }}" alt="" width="28">
            <div class="register-input">
              <label for="precio">{{ __('Precio bruto') }}</label>
              <input id="precio" type="number" name="precio" value="{{ old('precio') }}" autocomplete="precio" autofocus min="1" placeholder="1800" step="any" onkeyup="validarPrecio(this)">

              @error('precio')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="codigo">{{ __('Código') }}</label>
              <input id="codigo" type="text" name="codigo" value="{{ old('codigo') }}" autocomplete="codigo" autofocus placeholder="7675645432">
              
              @error('codigo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="register-double">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-unidad.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="unidad">{{ __('Unidad de medida') }}</label>
              <select name="unidad" id="unidad" autofocus>
                <option selected disabled value="">Seleccione una unidad de medida</option>
                @foreach($unidades as $unidad)
                  @if (old('unidad') == $unidad->unidad_medida_id)
                    <option selected value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                    @continue
                  @endif
                <option value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                @endforeach  
              </select>    

              @error('unidad')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-tipo.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="tipo">{{ __('Tipo (Producto o Servicio)') }}</label>
              <select name="tipo" id="tipo" autofocus>
                <option selected disabled value="">Seleccione un tipo</option>
                @foreach($tipos as $tipo)
                  @if (old('tipo') == $tipo->tipo_id)
                    <option selected value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                    @continue
                  @endif
                <option value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                @endforeach  
              </select> 

              @error('tipo')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
          <div class="register-input register-file">
            <label for="imagen">{{ __('Imagen') }}</label>
            <input id="imagen" type="file" name="imagen" value="{{ old('imagen') }}" autofocus onchange="vistaPreliminar(event)">

            @error('imagen')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="service-image">
          <img src="{{asset('images/productos_servicios/sinImagen.svg')}}" alt="" id="img_servicio" width="250">
        </div>

      </div>
    </div>
    <button class="form-cta" type="submit">{{ __('Registrar') }}</button>
  </form>
</div>

<script>
function validarPrecio(value) {
  let valor = $(value).val();
  if (isNaN(valor) || valor <= 0){
    $(value).val("");
  }
}

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
