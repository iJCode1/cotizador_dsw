@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Producto y/o Servicio') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.registerServicio') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        {{-- Nombre del Producto y/o Servicio--}}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Producto y/o Servicio') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Página web informativa">

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
                              <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" autofocus rows="3">{{ old('descripcion') }}</textarea>
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
                              <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" autocomplete="codigo" autofocus placeholder="7675645432">

                              @error('codigo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Imagen --}}
                        <div class="form-group row">
                          <label for="imagen" class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>

                          <div class="col-md-6">
                              <input id="imagen" type="file" class="mt-1 @error('imagen') is-invalid @enderror" name="imagen" value="{{ old('imagen') }}" autofocus>

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
                              <input id="precio" type="number" step="any" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" autocomplete="precio" autofocus placeholder="1800">

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

                        {{-- Unidad de Medida --}}
                        <div class="form-group row">
                          <label for="unidad" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de medida') }}</label>
            
                          <div class="col-md-6">
                            <select name="unidad" id="unidad" class="form-control @error('unidad') is-invalid @enderror" autofocus>
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

                        {{-- Boton de registrar --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
