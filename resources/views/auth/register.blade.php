@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Registrar') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            @if(!$tenantName)
              <p>Soy una empresa!</p>

              {{-- Dirección --}}
              <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                <div class="col-md-6">
                  <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                  @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              {{-- Código Postal --}}
              <div class="form-group row">
                <label for="postal" class="col-md-4 col-form-label text-md-right">{{ __('Código Postal') }}</label>

                <div class="col-md-2">
                  <input id="postal" type="text" class="form-control @error('postal') is-invalid @enderror" name="postal" value="{{ old('postal') }}" required autocomplete="postal" autofocus>

                  @error('postal')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                {{-- Número --}}
              
                <label for="number" class="col-md-2 col-form-label text-md-right">{{ __('Numero') }}</label>

                <div class="col-md-2">
                  <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                  @error('number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              {{-- Estado --}}
              <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                <div class="col-md-6">
                  <select name="estado" id="estado" class="form-control estado @error('estado') is-invalid @enderror" autofocus>
                    <option selected disabled value="">Seleccione un estado</option>
                    @foreach($estados as $estado)
                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                    @endforeach
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    @error('estado')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </select>

                  {{-- @error('rfc')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>

              {{-- Municipios --}}
              <div class="form-group row">
                <label for="municipios" class="col-md-4 col-form-label text-md-right">{{ __('Selecciona tu Municipio') }}</label>
                <div class="col-md-6">
                  <select name="municipios" id="municipios" class="form-control" autofocus>
                    <option selected disabled value="">Seleccione un municipio</option>
                  </select>
                </div>
              </div>

              {{-- RFC --}}
              <div class="form-group row">
                <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

                <div class="col-md-6">
                  <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}"  autocomplete="number" autofocus>

                  @error('rfc')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              {{-- Nombre de contacto --}}
              <div class="form-group row">
                <label for="nameContact" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Contacto') }}</label>

                <div class="col-md-6">
                  <input id="nameContact" type="text" class="form-control @error('nameContact') is-invalid @enderror" name="nameContact" value="{{ old('nameContact') }}" required autocomplete="nameContact" autofocus>

                  @error('nameContact')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              {{-- Telefono de contacto --}}
              <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                <div class="col-md-6">
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                  @error('phone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>


              <!-- Registro de un Inquilino (Empresa): fqdn - fully qualified domain name -->
              <div class="form-group row">
                <label for="fqdn" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la Empresa') }}</label>

                <div class="col-md-6">
                  <input id="fqdn" type="text" class="form-control @error('fqdn') is-invalid @enderror" name="fqdn" value="{{ old('fqdn') }}" required autocomplete="fqdn">

                  @error('fqdn')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

            @endif


            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

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

<script>

  window.onload = function exampleFunction() {
    
    $estadoSelect = document.getElementById("estado");
    $municipiosSelect = document.getElementById("municipios");

    $estadoSelect.addEventListener('change', ()=> {
      $municipiosSelect.innerHTML = "";
      let estadoID = $estadoSelect.selectedIndex;
      const municipios = @json($municipios);

      municipios.forEach((mun) => {
        if(mun.estado_id === estadoID){
          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          $municipiosSelect.appendChild(option);
        }
      });
    });
  }

</script>