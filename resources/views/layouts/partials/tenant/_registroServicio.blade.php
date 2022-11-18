<div class="register-form">
  <div class="service-fFirst">
    <p class="form-concept">Información del producto y/o servicio</p>

    <div class="form-inputs">
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-label.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="nombreServicio">{{ __('Nombre del producto y/o servicio') }}</label>
          <input id="nombreServicio" type="text" name="nombreServicio" value="{{ old('nombreServicio') }}" autocomplete="nombreServicio" autofocus placeholder="Página web informativa">

          <span id="nombreServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-descripcion.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="descripcionServicio">{{ __('Descripción del producto y/o servicio') }}</label>
          <textarea id="descripcionServicio" name="descripcionServicio" autofocus rows="2" placeholder="La página web cuenta con ...">{{ old('descripcionServicio') }}</textarea>

          <span id="descripcionServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>
      
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-price.svg') }}" alt="" width="28">
        <div class="register-input">
          <label for="precioServicio">{{ __('Precio bruto') }}</label>
          <input id="precioServicio" type="number" name="precioServicio" value="{{ old('precioServicio') }}" autocomplete="precioServicio" autofocus min="1" placeholder="1800" step="any" onkeyup="validarPrecio(this)">

          <span id="precioServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>
      <div class="register-data">
        <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="codigoServicio">{{ __('Código') }}</label>
          <input id="codigoServicio" type="text" name="codigoServicio" value="{{ old('codigoServicio') }}" autocomplete="codigoServicio" autofocus placeholder="7675645432">
          
          <span id="codigoServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-unidad.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="unidadServicio">{{ __('Unidad de medida') }}</label>
          <select name="unidadServicio" id="unidadServicio" autofocus>
            <option selected disabled value="">Seleccione una unidad de medida</option>
            @foreach($unidades as $unidad)
              @if (old('unidadServicio') == $unidad->unidad_medida_id)
                <option selected value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                @continue
              @endif
            <option value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
            @endforeach  
          </select>    

          <span id="unidadServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-tipo.svg') }}" alt="" width="26">
        <div class="register-input">
          <label for="tipoServicio">{{ __('Tipo (Producto o Servicio)') }}</label>
          <select name="tipoServicio" id="tipoServicio" autofocus>
            <option selected disabled value="">Seleccione un tipo</option>
            @foreach($tipos as $tipo)
              @if (old('tipoServicio') == $tipo->tipo_id)
                <option selected value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                @continue
              @endif
            <option value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
            @endforeach  
          </select> 

          <span id="tipoServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>

      <div class="register-data">
        <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
        <div class="register-input register-file">
          <label for="imagenServicio">{{ __('Imagen') }}</label>
          <input id="imagenServicio" type="file" name="imagenServicio" value="{{ old('imagenServicio') }}" autofocus onchange="vistaPreliminar(event)">

          <span id="imagenServicio-error" class="invalid-feedbackk" role="alert">
            <strong></strong>
          </span>
        </div>
      </div>

      <div class="service-image">
        <img src="{{asset('images/productos_servicios/sinImagen.svg')}}" alt="" id="img_servicio" width="250">
      </div>

    </div>
  </div>
</div>