@extends('layouts.app')

@section('content')
<div class="employees">
  <div class="employees-first">
    <div class="employees-title">
      <img src="{{ asset('images/icons/icon-empresas_black.svg') }}" class="nav-icon" alt="Icono de empresas" title="Icono de empresas" width="24">
      <h2>{{ __('Editar empleado') }}</h2>
    </div>
  </div>
  <form class="employees-form" method="POST" action="{{ route('tenant.editUser', $usuarioFind) }}">
    @method('put')
    @csrf

    <div class="employees-fFirst">
      <p class="form-concept">Información del Empleado</p>

      <div class="form-inputs">
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="correo">{{ __('Correo electrónico') }}</label>
            <p class="read-only">{{$usuarioFind->email}}</p>
            
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-personName.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="nombre">{{ __('Nombre del empleado') }}</label>
            <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $usuarioFind->nombre) }}" autocomplete="nombre" autofocus placeholder="Julieta">

            @error('nombre')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="register-double">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="app">{{ __('Apellido paterno') }}</label>
              <input id="app" type="text" name="app" value="{{ old('app', $usuarioFind->apellido_p) }}" autocomplete="app" autofocus placeholder="Sanchez">

              @error('app')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="register-data">
            <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="apm">{{ __('Apellido materno') }}</label>
              <input id="apm" type="text" name="apm" value="{{ old('apm', $usuarioFind->apellido_m) }}" autocomplete="apm" autofocus placeholder="Cortez">

              @error('apm')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-map_black.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="direccion">{{ __('Dirección') }}</label>
            <input id="direccion" type="text" name="direccion" value="{{ old('direccion', $usuarioFind->direccion) }}" autocomplete="direccion" autofocus placeholder="Calle Lago de la Gaviota #218">

            @error('direccion')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="register-data">
          <img src="{{ asset('images/icons/icon-phone_black.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="telefono">{{ __('Teléfono') }}</label>
            <input id="telefono" type="tel" name="telefono" value="{{ old('telefono', $usuarioFind->telefono) }}" autocomplete="telefono" autofocus placeholder="7225634563">

            @error('telefono')
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        
        <div class="register-data">
          <img src="{{ asset('images/icons/icon-tipo_user_black.svg') }}" alt="" width="26">
          <div class="register-input">
            <label for="rol">{{ __('Tipo de usuario') }}</label>
            <select name="rol" id="rol" autofocus>
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
            <span class="invalid-feedbackk" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

      </div>
    </div>
    <button class="form-cta" type="submit">{{ __('Editar') }}</button>
  </form>
</div>
@endsection