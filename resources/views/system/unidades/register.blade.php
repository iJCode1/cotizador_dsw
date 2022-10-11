@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
          <div class="card-header">{{ __('Registrar Unidad de Medida') }}</div>

          <div class="card-body">
              <form method="POST" action="{{ route('tenant.registerUnidad') }}">
                  @csrf
                  @method('post')

                  {{-- Nombre de la unidad --}}
                  <div class="form-group row">
                      <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la Unidad') }}</label>

                      <div class="col-md-6">
                          <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="unidad">

                          @error('nombre')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>

                  {{-- Abreviación --}}
                  <div class="form-group row">
                    <label for="abrev" class="col-md-4 col-form-label text-md-right">{{ __('Abreviación') }}</label>

                    <div class="col-md-6">
                        <input id="abrev" type="text" class="form-control @error('abrev') is-invalid @enderror" name="abrev" value="{{ old('abrev') }}" autocomplete="abrev" autofocus placeholder="abrev">

                        @error('abrev')
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