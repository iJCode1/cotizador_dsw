{{-- Nombre del Producto y/o Servicio--}}
<div class="form-group row">
  <label for="nombreServicio" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Producto y/o Servicio') }}</label>

  <div class="col-md-6">
      <input id="nombreServicio" type="text" class="form-control @error('nombreServicio') is-invalid @enderror" name="nombreServicio" value="{{ old('nombreServicio') }}" autocomplete="nombreServicio" autofocus placeholder="Página web informativa">

      <span id="nombreServicio-error" class="invalid-feedback" role="alert">
        <strong></strong>
      </span>
  </div>
</div>

{{-- Descripción --}}
<div class="form-group row">
<label for="descripcionServicio" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

<div class="col-md-6">
    <textarea id="descripcionServicio" class="form-control @error('descripcionServicio') is-invalid @enderror" name="descripcionServicio" autofocus rows="3">{{ old('descripcionServicio') }}</textarea>
    
    <span id="descripcionServicio-error" class="invalid-feedback" role="alert">
      <strong></strong>
    </span>
</div>
</div>

{{-- Código --}}
<div class="form-group row">
<label for="codigoServicio" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>

<div class="col-md-6">
    <input id="codigoServicio" type="text" class="form-control @error('codigoServicio') is-invalid @enderror" name="codigoServicio" value="{{ old('codigoServicio') }}" autocomplete="codigoServicio" autofocus placeholder="7675645432">

    <span id="codigoServicio-error" class="invalid-feedback" role="alert">
      <strong></strong>
    </span>
</div>
</div>

{{-- Imagen --}}
<div class="form-group row">
<label for="imagenServicio" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

<div class="col-md-6">
    <input id="imagenServicio" type="file" class="mt-1 @error('imagenServicio') is-invalid @enderror" name="imagenServicio" value="{{ old('imagenServicio') }}" autofocus onchange="vistaPreliminar(event)">

    <span id="imagenServicio-error" class="invalid-feedback" role="alert">
      <strong></strong>
    </span>
</div>
</div>
<div class="d-flex justify-content-center mb-4">
  <img src="{{asset('images/productos_servicios/sinImagen.svg')}}" alt="Imagen del producto y/o servicio" id="img_servicio" width="250">
</div>

{{-- Precio bruto --}}
<div class="form-group row">
<label for="precioServicio" class="col-md-4 col-form-label text-md-right">{{ __('Precio bruto') }}</label>

<div class="col-md-6">
    <input id="precioServicio" type="number" step="any" class="form-control @error('precioServicio') is-invalid @enderror" name="precioServicio" value="{{ old('precioServicio') }}" autocomplete="precioServicio" autofocus min="1" placeholder="1800" step="any" onkeyup="validarPrecio(this)">

    <span id="precioServicio-error" class="invalid-feedback" role="alert">
      <strong></strong>
    </span>
</div>
</div>

{{-- Tipo --}}
<div class="form-group row">
<label for="tipoServicio" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

<div class="col-md-6">
  <select name="tipoServicio" id="tipoServicio" class="form-control @error('tipoServicio') is-invalid @enderror" autofocus>
    <option selected disabled value="">Seleccione un tipo</option>
    @foreach($tipos as $tipo)
      @if (old('tipoServicio') == $tipo->tipo_id)
        <option selected value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
        @continue
      @endif
    <option value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
    @endforeach
  </select>    
          
  <span id="tipoServicio-error" class="invalid-feedback" role="alert">
    <strong></strong>
  </span>
</div>
</div>

{{-- Unidad de Medida --}}
<div class="form-group row">
<label for="unidadServicio" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de medida') }}</label>

<div class="col-md-6">
  <select name="unidadServicio" id="unidadServicio" class="form-control @error('unidadServicio') is-invalid @enderror" autofocus>
    <option selected disabled value="">Seleccione una unidad de medida</option>
    @foreach($unidades as $unidad)
      @if (old('unidadServicio') == $unidad->unidad_medida_id)
        <option selected value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
        @continue
      @endif
    <option value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
    @endforeach
  </select>    
          
  <span id="unidadServicio-error" class="invalid-feedback" role="alert">
    <strong></strong>
  </span>
</div>
</div>