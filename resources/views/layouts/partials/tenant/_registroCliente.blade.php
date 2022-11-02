{{-- Nombre --}}
<div class="form-group row">
  <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

  <div class="col-md-6">
      <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Fernando">
      
      <span id="nombre-error" class="invalid-feedback" role="alert" style="display: none">
        <strong></strong>
      </span>
  </div>
</div>

{{-- Apellido Paterno --}}
<div class="form-group row">
<label for="apep" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

<div class="col-md-6">
    <input id="apep" type="text" class="form-control @error('apep') is-invalid @enderror" name="apep" value="{{ old('apep') }}" autocomplete="apep" autofocus placeholder="Díaz">
    
    <span id="apep-error" class="invalid-feedback" role="alert" style="display: none">
      <strong></strong>
    </span>
</div>
</div>

{{-- Apellido Materno --}}
<div class="form-group row">
<label for="apm" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

<div class="col-md-6">
    <input id="apm" type="text" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm') }}" autocomplete="apm" autofocus placeholder="Álvarez">

    <span id="apm-error" class="invalid-feedback" role="alert" style="display: none">
      <strong></strong>
    </span>
</div>
</div>

{{-- Dirección --}}
<div class="form-group row">
<label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

<div class="col-md-6">
    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" autocomplete="direccion" autofocus placeholder="Privada del Sol #12">

    <span id="direccion-error" class="invalid-feedback" role="alert" style="display: none">
      <strong></strong>
    </span>
</div>
</div>

{{-- Telefono --}}
<div class="form-group row">
<label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

<div class="col-md-6">
    <input id="telefono" type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus placeholder="xxxxxxxxxx">

    <span id="telefono-error" class="invalid-feedback" role="alert" style="display: none">
      <strong></strong>
    </span>
</div>
</div>

{{-- Email --}}
<div class="form-group row">
  <label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

  <div class="col-md-6">
      <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" autocomplete="email" placeholder="example@example.com">

      <span id="correo-error" class="invalid-feedback" role="alert" style="display: none">
        <strong></strong>
      </span>
  </div>
</div>

{{-- Password --}}
<div class="form-group row">
  <label for="contraseña" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

  <div class="col-md-6">
      <input id="contraseña" type="password" class="form-control @error('contraseña') is-invalid @enderror" name="contraseña" autocomplete="new-password" placeholder="********">

      <span id="contraseña-error" class="invalid-feedback" role="alert" style="display: none">
        <strong></strong>
      </span>
  </div>
</div>

{{-- Confirmar Password --}}
<div class="form-group row">
  <label for="confirmar_contraseña" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

  <div class="col-md-6">
      <input id="confirmar_contraseña" type="password" class="form-control @error('confirmar_contraseña') is-invalid @enderror" name="confirmar_contraseña" autocomplete="new-password" placeholder="********">
      
      <span id="confirmar_contraseña-error" class="invalid-feedback" role="alert" style="display: none">
        <strong></strong>
      </span>
  </div>
</div>