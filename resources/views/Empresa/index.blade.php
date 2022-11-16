@extends('layouts.app')

@section('content')

  <div class="company">
    <div class="company-first">
      <div class="company-title">
        <img src="{{ asset('images/icons/icon-empresas_black.svg') }}" class="nav-icon" alt="Icono de empresas" title="Icono de empresas" width="24">
        <h2>Empresas</h2>
      </div>
      <a href="{{ route('altaEmpresa') }}" class="company-button">
        <span>+</span>
        <span>Nuevo registro</span>
      </a>
    </div>
    @if (count($empresas) <= 0)
      <div class="company-second">
        <img src="{{ asset('images/illustrations/empresas.svg') }}" alt="Empresas" title="No hay empresas registradas" width="250">
        <p>No hay empresas registradas</p>
      </div>
    @else
      <div class="company-cards">
        @foreach ($empresas as $empresa)   
          <div class="card">
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-company_black.svg') }}" class="nav-icon" alt="Icono de empresa" title="Empresa" width="28">
              <div class="card-body">
                <h2>Empresa</h2>
                <p>{{$empresa->fqdn}}</p>
              </div>
            </div>
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-globe_black.svg') }}" class="nav-icon" alt="Icono de hostname" title="Hostname" width="28">
              <div class="card-body">
                <h2>Hostname</h2>
                <a href="http://{{$empresa->hostname->fqdn}}:8000" target="_blank" rel="noreferrer">{{$empresa->hostname->fqdn}}</a>
              </div>
            </div>
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-map_black.svg') }}" class="nav-icon" alt="Icono de dirección" title="Dirección" width="28">
              <div class="card-body">
                <h2>Dirección</h2>
                <p>{{$empresa->direccion}}</p>
              </div>
            </div>
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-person_black.svg') }}" class="nav-icon" alt="Icono de administrador" title="Administrador" width="28">
              <div class="card-body">
                <h2>Administrador</h2>
                <p>{{$empresa->nombre_contacto." ".$empresa->apellido_p." ".$empresa->apellido_m}}</p>
              </div>
            </div>
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-phone_black.svg') }}" class="nav-icon" alt="Icono de teléfono" title="Teléfono" width="28">
              <div class="card-body">
                <h2>Teléfono</h2>
                <p>{{$empresa->telefono}}</p>
              </div>
            </div>
            <div class="card-item">
              <img src="{{ asset('images/icons/icon-actions_black.svg') }}" class="nav-icon" alt="Icono de acciones" title="Acciones" width="28">
              <div class="card-body">
                <h2>Acciones</h2>
                <div class="card-actions">
                  <a href="{{ route('editarEmpresa', $empresa) }}" class="card-edit">
                    <img src="{{ asset('images/icons/icon-edit.svg') }}" class="nav-icon" alt="Icono de editar" title="Editar" width="26">
                    Editar
                  </a>
                  @foreach ($websites as $website)
                    @if ($empresa->hostname->website_id === $website->id)
                    <td>
                      @if ($website->deleted_at != NULL)
                        <form class="card-form" id="activateForm" action="{{ route('activateEmpresa', ['id' => $website->id]) }}">
                          @csrf
                          <img src="{{ asset('images/icons/icon-activate.svg') }}" class="nav-icon" alt="Icono de activar" title="Activar" width="24">
                          <button type="submit">Activar</button>
                        </form>
                      @else
                        <form class="card-form" id="deleteForm" action="{{ Route('desactivarEmpresa', ['id' => $website->id]) }}">
                          @method("DELETE")
                          @csrf
                          <img src="{{ asset('images/icons/icon-disabled.svg') }}" class="nav-icon" alt="Icono de eliminar" title="Desactivar" width="24">
                          <button type="submit">Desactivar</button>
                        </form>
                      @endif
                    </td>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
    
  </div>

  <script>

    const d = document;

    const deleteForms = d.querySelectorAll('#deleteForm');

    deleteForms.forEach(form => {
      form.addEventListener('click', function(event){
        event.preventDefault();
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Se desactivará esta empresa",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Si, desactivar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })
      })
    });

    const activateforms = d.querySelectorAll('#activateForm');

    activateforms.forEach(form => {
      form.addEventListener('click', function(event){
        event.preventDefault();
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Se activará esta empresa",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Si, activar!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })
      })
    });

  </script>

  @if (session('crear') === 'ok')
    <script>
      Swal.fire(
        'Registrado!',
        '¡La empresa ha sido registrada con éxito!',
        'success'
      )
    </script>
  @endif

  @if (session('editar') === 'ok')
    <script>
      Swal.fire(
        'Editado!',
        '¡La empresa se ha editado correctamente!',
        'success'
      )
    </script>
  @endif

  @if (session('eliminar') === 'ok')
    <script>
      Swal.fire(
        'Desactivado!',
        '¡La empresa se ha desactivado con éxito!',
        'success'
      )
    </script>
  @endif

  @if (session('activar') === 'ok')
    <script>
      Swal.fire(
        'Activado!',
        '¡La empresa se ha activado con éxito!',
        'success'
      )
    </script>
  @endif
@endsection