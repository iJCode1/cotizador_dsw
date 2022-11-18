<div class="register-form">
  <p class="form-concept concept-cliente">Información del Cliente</p>

  <div class="register-name register-data">
    <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="nombre">{{ __('Nombre') }}</label>
      <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Julieta">
  
      <span id="nombre-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-lastname1 register-data">
    <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="apep">{{ __('Apellido paterno') }}</label>
      <input id="apep" type="text" name="apep" name="apep" value="{{ old('apep') }}" autocomplete="apep" autofocus placeholder="Vega">
  
      <span id="apep-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-lastname2 register-data">
    <img src="{{ asset('images/icons/icon-person.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="apm">{{ __('Apellido Materno') }}</label>
      <input id="apm" type="text" name="apm" value="{{ old('apm') }}" autocomplete="apm" autofocus placeholder="Álvarez">
      
      <span id="apm-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-address register-data">
    <img src="{{ asset('images/icons/icon-map.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="direccion">{{ __('Dirección') }}</label>
      <input id="direccion" type="text" name="direccion" value="{{ old('direccion') }}" autocomplete="direccion" autofocus placeholder="Calle del Sol #45, Col. 5 soles, Toluca, Edo. México">
  
      <span id="direccion-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-phone register-data">
    <img src="{{ asset('images/icons/icon-phone.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="telefono">{{ __('Teléfono') }}</label>
      <input id="telefono" type="tel" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus placeholder="7226745674">
      
      <span id="telefono-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-email register-data">
    <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="correo">{{ __('Correo electrónico') }}</label>
      <input id="correo" type="email" name="correo" value="{{ old('correo') }}" autocomplete="email" placeholder="example@email.com">
  
      <span id="correo-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
  
  <div class="register-password register-data">
    <img src="{{ asset('images/icons/icon-password.svg') }}" alt="" width="32">
    <div class="register-input">
      <label for="contraseña">{{ __('Contraseña') }}</label>
      <input id="contraseña" type="password" name="contraseña" autocomplete="password" placeholder="**********">
  
      <span id="contraseña-error" class="invalid-feedbackk" role="alert" style="display: none">
        <strong></strong>
      </span>
    </div>
  </div>
</div>