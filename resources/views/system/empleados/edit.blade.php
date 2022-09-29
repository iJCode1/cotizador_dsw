@extends('layouts.app')

@section('content')
<div class="container">
  {{-- {{dd($usuarioFind)}} --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.editUser', $usuarioFind) }}">
                        @method('put')
                        @csrf

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $usuarioFind->nombre) }}" autocomplete="nombre" autofocus placeholder="Julieta">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Apellido Paterno --}}
                        <div class="form-group row">
                          <label for="app" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                          <div class="col-md-6">
                              <input id="app" type="text" class="form-control @error('app') is-invalid @enderror" name="app" value="{{ old('app', $usuarioFind->apellido_p) }}" autocomplete="app" autofocus placeholder="Sanchez">

                              @error('app')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Apellido Materno --}}
                        <div class="form-group row">
                          <label for="apm" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                          <div class="col-md-6">
                              <input id="apm" type="text" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm', $usuarioFind->apellido_m) }}" autocomplete="apm" autofocus placeholder="Cortez">

                              @error('apm')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="form-group row">
                          <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                          <div class="col-md-6">
                              <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion', $usuarioFind->direccion) }}" autocomplete="direccion" autofocus placeholder="Calle Lago de la Gaviota #218">

                              @error('direccion')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Telefono --}}
                        <div class="form-group row">
                          <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                          <div class="col-md-6">
                              <input id="telefono" type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono', $usuarioFind->telefono) }}" autocomplete="telefono" autofocus placeholder="xxxxxxxxxx">

                              @error('telefono')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>
                        
                        {{-- Tipo de Rol --}}
                        <div class="form-group row">
                          <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>
                          <div class="col-md-6">
                            <select name="rol" id="rol" class="form-control rol @error('rol') is-invalid @enderror" autofocus>
                              <option selected disabled value="">Seleccione un tipo de usuario</option>
                              @foreach($roles as $rol)
                                @if (old('rol'))
                                  @if (old('rol') == $rol->rol_id)
                                    <option selected value="{{$rol->rol_id}}">{{$rol->nombre_rol}}</option>
                                    @continue
                                  @endif
                                @else
                                  @if ($usuarioFind->rol_id == $rol->rol_id)
                                    <option selected value="{{$rol->rol_id}}">{{$rol->nombre_rol}}</option>
                                    @continue
                                  @endif
                                @endif
                                <option value="{{$rol->rol_id}}">{{$rol->nombre_rol}}</option>  
                              @endforeach
                            </select>
                            @error('rol')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>

                        {{-- Boton de registrar --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block btn-warning">
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
@endsection
