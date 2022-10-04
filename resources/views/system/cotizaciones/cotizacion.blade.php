@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Crear Cotizacion') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('tenant.cotizacion') }}">
            @csrf

            {{-- Producto y/o Servicio --}}
            <div class="form-group row">
              <label for="servicio" class="col-md-4 col-form-label text-md-right">{{ __('Buscar Producto y/o Servicio') }}</label>

              <div class="col-md-6">
                <input id="servicio" type="text" class="form-control @error('servicio') is-invalid @enderror" name="servicio" value="{{ old('servicio') }}" autocomplete="servicio" autofocus>

                @error('servicio')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Nombre de la Cotización --}}
            <div class="form-group row">
              <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la cotización') }}</label>

              <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus>

                @error('nombre')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Descripcion --}}
            <div class="form-group row">
              <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

              <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" autocomplete="text" autofocus>

                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Fecha de creación --}}
            <div class="form-group row">
              <label for="fecha_creacion" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de creación') }}</label>

              <div class="col-md-6">
                <input id="fecha_creacion" type="date" class="form-control @error('fecha_creacion') is-invalid @enderror" name="fecha_creacion" value="{{ old('fecha_creacion') }}" autocomplete="fecha_creacion" autofocus>

                @error('fecha_creacion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Vigencia --}}
            <div class="form-group row">
              <label for="vigencia" class="col-md-4 col-form-label text-md-right">{{ __('Vigencia (Días)') }}</label>

              <div class="col-md-6">
                <input id="vigencia" type="number" class="form-control @error('vigencia') is-invalid @enderror" name="vigencia" value="{{ old('vigencia') }}" autocomplete="vigencia" autofocus>

                @error('vigencia')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Estatus de Cotización --}}
            <div class="form-group row">
              <label for="estatus" class="col-md-4 col-form-label text-md-right">{{ __('Estatus de la cotización') }}</label>

              <div class="col-md-6">
                <select name="estatus" id="estatus" class="form-control estatus @error('estatus') is-invalid @enderror" autofocus>
                  
                  <option selected disabled value="">Selecciona el status</option>
                  @foreach($estatus as $estatu)
                    @if (old('estatus') == $estatu->estatus_cotizacion_id)
                      {{-- {{dd("Algo")}} --}}
                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                      @continue
                    @endif
                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                  @endforeach
                  
                  @error('estatus')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </select>
              </div>
            </div>
            
            {{-- Estado --}}
            {{-- <div class="form-group row">
              <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

              <div class="col-md-6">
                <select name="estado" id="estado" class="form-control estado @error('estado') is-invalid @enderror" autofocus>
                  <option selected disabled value="">Seleccione un estado</option>
                  @foreach($estados as $estado)
                    @if (old('estado') == $estado->estado_id)
                      <option selected value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                      @continue
                    @endif
                  <option value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                  @endforeach
                  <div class="valid-feedback">
                    Correcto!
                  </div>
                  @error('estado')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </select>

                @error('estado')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

              </div>
            </div> --}}


            {{-- CTA --}}
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-block btn-primary">
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
