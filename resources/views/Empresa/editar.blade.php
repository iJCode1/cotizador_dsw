@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Registrar') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('actualizarEmpresa', $empresa) }}">
            @method('put')
            @csrf
            
            <!-- Registro de un Inquilino (Empresa): fqdn - fully qualified domain name -->
            <div class="form-group row">
              <label for="fqdn" class="col-md-4 col-form-label text-md-right">{{ __('Dominio') }}</label>

              <div class="col-md-6">
                <input id="fqdn" type="text" class="form-control @error('fqdn') is-invalid @enderror" name="fqdn" value="{{ old('fqdn', $fqdn) }}" required autocomplete="fqdn" readonly>

                @error('fqdn')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Correo Electrónico --}}
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $empresa->correo_electronico) }}" required autocomplete="email" readonly>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Dirección --}}
            <div class="form-group row">
              <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

              <div class="col-md-6">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $empresa->direccion) }}" required autocomplete="address" autofocus>

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
                <input id="postal" type="text" class="form-control @error('postal') is-invalid @enderror" name="postal" value="{{ old('postal', $empresa->codigo_postal) }}" required autocomplete="postal" autofocus>

                @error('postal')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              {{-- Número --}}
              <label for="number" class="col-md-2 col-form-label text-md-right">{{ __('Numero') }}</label>

              <div class="col-md-2">
                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number', $empresa->numero) }}" required autocomplete="number" autofocus>

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
                    @if ($estado->nombre  === $estadoEmpresa)
                      <option value="{{$estado->estado_id}}" selected>{{$estado->nombre}}</option>
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
              </div>
            </div>
              
            {{-- Municipios --}}
            <div class="form-group row">
              <label for="municipio" class="col-md-4 col-form-label text-md-right">{{ __('Selecciona tu Municipio') }}</label>
              <div class="col-md-6">
                <select name="municipio_id" id="municipio" class="form-control" autofocus>
                  <option disabled value="">Seleccione un municipio</option>
                  @foreach ($municipiosEmpresa as $municipioE)
                  {{-- {{dd($municipioEmpresa)}} --}}
                    @if ($municipioE->municipio_id === $municipioEmpresa->municipio_id)
                      <option selected value="{{$municipioE->municipio_id}}">{{ $municipioE->nombre }}</option>
                      @continue
                    @endif
                    <option value="{{$municipioE->municipio_id}}">{{ $municipioE->nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            {{-- RFC --}}
            <div class="form-group row">
              <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

              <div class="col-md-6">
                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc', $empresa->rfc) }}"  autocomplete="number" autofocus>

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
                <input id="nameContact" type="text" class="form-control @error('nameContact') is-invalid @enderror" name="nameContact" value="{{ old('nameContact', $empresa->nombre_contacto) }}" required autocomplete="nameContact" autofocus>

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
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $empresa->telefono) }}" required autocomplete="phone" autofocus>

                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

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

<script>

  window.onload = function exampleFunction() {
    
    $estadoSelect = document.getElementById("estado");
    $municipiosSelect = document.getElementById("municipio");

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