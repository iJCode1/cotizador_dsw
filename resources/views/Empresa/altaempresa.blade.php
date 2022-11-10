@extends('../layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Registrar') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('registrarEmpresa') }}">
            @csrf

            <!-- Registro de un Inquilino (Empresa): fqdn - fully qualified domain name -->
            <div class="form-group row">
              <label for="fqdn" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la Empresa') }}</label>

              <div class="col-md-6">
                <input id="fqdn" type="text" class="form-control @error('fqdn') is-invalid @enderror" name="fqdn" value="{{ old('fqdn') }}" autocomplete="fqdn">

                @error('fqdn')
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
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

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
                <input id="postal" type="text" class="form-control @error('postal') is-invalid @enderror" name="postal" value="{{ old('postal') }}" autocomplete="postal" autofocus>

                @error('postal')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              {{-- Número --}}
            
              <label for="number" class="col-md-2 col-form-label text-md-right">{{ __('Numero') }}</label>

              <div class="col-md-2">
                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" autocomplete="number" autofocus>

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

                {{-- @error('rfc')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
              </div>
            </div>
            {{-- {{dd(old('municipio_id'))}} --}}
            {{-- {{dd(old('estado'))}} --}}
            {{-- {{dd($estados[0])}} --}}


            {{-- Municipios --}}
            <div class="form-group row">
              <label for="municipio" class="col-md-4 col-form-label text-md-right">{{ __('Selecciona tu Municipio') }}</label>
              <div class="col-md-6">
                <select name="municipio_id" id="municipio" class="form-control municipio_id @error('municipio_id') is-invalid @enderror" autofocus>
                  <option selected disabled value="">Seleccione un municipio</option>
                  {{-- @foreach($municipios as $municipio)
                    @if (old('municipio_id') == $estado->estado_id)
                      {{dd("Algo")}}
                      <option selected value="{{$estado->estado_id}}">{{$estado->nombre}}</option>
                      @continue
                    @endif
                  @endforeach --}}
                </select>
                @error('municipio_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

         

            {{-- RFC --}}
            <div class="form-group row">
              <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

              <div class="col-md-6">
                <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}" autocomplete="number" autofocus>

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
                <input id="nameContact" type="text" class="form-control @error('nameContact') is-invalid @enderror" name="nameContact" value="{{ old('nameContact') }}" autocomplete="nameContact" autofocus>

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
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>

                @error('phone')
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Contraseña --}}
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="off" >

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
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

  window.onload = function mostrarOptions() {
    
    $estadoSelect = document.getElementById("estado");
    $municipiosSelect = document.getElementById("municipio");
    const municipios = @json($municipios);
    let estadoID;

    $estadoSelect.addEventListener('change', ()=> {
      $municipiosSelect.innerHTML = "";
      estadoID = $estadoSelect.selectedIndex

      municipios.forEach((mun) => {
        if(mun.estado_id === estadoID){
          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          $municipiosSelect.appendChild(option);
        }
      });
    });


    

    if(@json(old('municipio_id'))){
      let municipioOld = 0;
      let estado_id = 0;
      municipioOld = @json(old('municipio_id'));

      municipios.forEach((mun) => {
        if(mun.municipio_id == municipioOld){
          estado_id = mun.estado_id
        }
      });

      municipios.forEach((mun) => {
        if(mun.estado_id == estado_id){

          let option = document.createElement('option');
          option.value= mun.municipio_id;
          option.textContent = mun.nombre;
          if(municipioOld == mun.municipio_id){
            option.setAttribute("selected", true);
          }
          $municipiosSelect.appendChild(option);
        }
      });
    }

  }

</script>