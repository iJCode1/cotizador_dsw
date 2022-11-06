@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de cliente') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.register') }}">
                        @csrf

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus placeholder="Fernando">

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
                              <input id="app" type="text" class="form-control @error('app') is-invalid @enderror" name="app" value="{{ old('app') }}" autocomplete="app" autofocus placeholder="Díaz">

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
                              <input id="apm" type="text" class="form-control @error('apm') is-invalid @enderror" name="apm" value="{{ old('apm') }}" autocomplete="apm" autofocus placeholder="Álvarez">

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
                              <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" autocomplete="direccion" autofocus placeholder="Privada del Sol #12">

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
                              <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus placeholder="xxxxxxxxxx">

                              @error('telefono')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" autocomplete="email" placeholder="example@example.com">

                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row">
                            <label for="contraseña" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="contraseña" type="password" class="form-control @error('contraseña') is-invalid @enderror" name="contraseña" autocomplete="new-password" placeholder="********">

                                @error('contraseña')
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
