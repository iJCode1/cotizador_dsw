@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  {{-- {{dd($servicio)}} --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Producto y/o Servicio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.editServicio', $servicio) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- Nombre del Producto y/o Servicio--}}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Producto y/o Servicio') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" autocomplete="nombre" autofocus placeholder="Página web informativa">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group row">
                          <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                          <div class="col-md-6">
                              <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" autofocus rows="3">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                              @error('descripcion')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Código --}}
                        <div class="form-group row">
                          <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>

                          <div class="col-md-6">
                              <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo', $servicio->codigo) }}" autocomplete="codigo" autofocus placeholder="7675645432">

                              @error('codigo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Imagen --}}
                        <div class="d-flex justify-content-center">
                          <img src="{{ asset('images/productos_servicios/'.$servicio->imagen) }}" id="img_servicio" alt="Imagen del producto y/o servicio" width="200">
                        </div>
                        <div class="form-group row">
                          <label for="imagen" class="col-md-4 col-form-label text-md-right">{{ __('¿Cambiar Imagen?') }}</label>

                          <div class="col-md-6">
                              <input id="imagen" type="file" class="mt-1 @error('imagen') is-invalid @enderror" name="imagen" value="{{ $servicio->imagen }}" autofocus onchange="vistaPreliminar(event)">

                              @error('imagen')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Precio bruto --}}
                        <div class="form-group row">
                          <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio bruto') }}</label>

                          <div class="col-md-6">
                              <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio', $servicio->precio_bruto) }}" autocomplete="precio" autofocus min="1" placeholder="1800" step="any" onkeyup="validarPrecio(this)">

                              @error('precio')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Tipo --}}
                        <div class="form-group row">
                          <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
            
                          <div class="col-md-6">
                            <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" autofocus>
                              <option selected disabled value="">Seleccione un tipo</option>
                              @if ($servicio->tipo_id)
                                @foreach($tipos as $tipo)
                                  @if ($servicio->tipo_id === $tipo->tipo_id)
                                    <option selected value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                                    @continue
                                  @endif
                                  <option value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                                @endforeach
                              @else    
                                @foreach($tipos as $tipo)
                                  @if (old('tipo') == $tipo->tipo_id)
                                    <option selected value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                                    @continue
                                  @endif
                                <option value="{{$tipo->tipo_id}}">{{$tipo->nombre_tipo}}</option>
                                @endforeach
                              @endif

                              @error('tipo')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror

                            </select>            
                          </div>
                        </div>

                        {{-- Unidad de Medida --}}
                        <div class="form-group row">
                          <label for="unidad" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de medida') }}</label>
            
                          <div class="col-md-6">
                            <select name="unidad" id="unidad" class="form-control @error('unidad') is-invalid @enderror" autofocus>
                              <option selected disabled value="">Seleccione una unidad de medida</option>

                              @if ($servicio->unidad_medida_id)
                                @foreach($unidades as $unidad)
                                  @if ($servicio->unidad_medida_id === $unidad->unidad_medida_id)
                                    <option selected value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                                    @continue
                                  @endif
                                  <option value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                                @endforeach
                              @else      
                                @foreach($unidades as $unidad)
                                  @if (old('unidad') == $unidad->unidad_medida_id)
                                    <option selected value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                                    @continue
                                  @endif
                                <option value="{{$unidad->unidad_medida_id}}">{{$unidad->nombre_unidad}}</option>
                                @endforeach
                              @endif

                              @error('unidad')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror

                            </select>            
                          </div>
                        </div>

                        {{-- Boton de registrar --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Editar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
