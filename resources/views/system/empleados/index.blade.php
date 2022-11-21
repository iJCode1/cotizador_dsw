@extends('layouts.app')

@section('title')
  <title>Empleados</title>
@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/empleados.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="employees">
  <div class="employees-first">
    <div class="employees-title">
      <img src="{{ asset('images/icons/icon-empleados_black.svg') }}" class="nav-icon" alt="Icono de empleados" title="Icono de empleados" width="24">
      <h2>Empleados</h2>
    </div>
    <a href="{{ route('tenant.showRegister') }}" class="employees-button">
      <span>+</span>
      <span>Nuevo registro</span>
    </a>
  </div>
  @if (count($usuarios) <= 0)
    <div class="employees-second">
      <img src="{{ asset('images/illustrations/employees.svg') }}" alt="Empresas" title="No hay empresas registradas" width="250">
      <p>No hay empleados</p>
    </div>
  @else
  <div class="rtable">
    <div class="rtable-head">
      <p class="rtable-col rtable-id">ID</p>
      <p class="rtable-col rtable-name">Nombre</p>
      <p class="rtable-col rtable-lastnamep">Apellido paterno</p>
      <p class="rtable-col rtable-lastnamem">Apellido materno</p>
      <p class="rtable-col rtable-address">Dirección</p>
      <p class="rtable-col rtable-phone">Teléfono</p>
      <p class="rtable-col rtable-email">Correo electrónico</p>
      <p class="rtable-col rtable-actions">Acciones</p>
    </div>
    <div class="rtable-body">
      @foreach ($usuarios as $usuario)
        <div class="rtable-row">
          <p class="rtable-item rtable-id">{{$usuario->user_id}}</p>
          <p class="rtable-item rtable-name">{{$usuario->nombre}}</p>
          <p class="rtable-item rtable-lastnamep">{{$usuario->apellido_p}}</p>
          <p class="rtable-item rtable-lastnamem">{{$usuario->apellido_m}}</p>
          <p class="rtable-item rtable-address">{{$usuario->direccion}}</p>
          <p class="rtable-item rtable-phone">{{$usuario->telefono}}</p>
          <p class="rtable-item rtable-email">{{$usuario->email}}</p>
          <div class="rtable-group rtable-actions">
            <a class="rtable-link" href="{{ route('tenant.showUser', ['usuario_id' => $usuario->user_id]) }}">
              <img src="{{ asset('images/icons/icon-eye.svg') }}" class="rtable-icon" alt="Icono de ver" title="Ver" width="22">
              <span class="rtable-span">Ver</span>
            </a>
            <a class="rtable-link" href="{{ route('tenant.showEditUser', ['usuario_id' => $usuario->user_id]) }}">
              <img src="{{ asset('images/icons/icon-edit.svg') }}" class="rtable-icon" alt="Icono de editar" title="Editar" width="22">
              <span class="rtable-span">Editar</span>
            </a>
            @if ($usuario->deleted_at != NULL)
              <form id="activateForm" action="{{ route('tenant.activateUser', ['usuario_id' => $usuario->user_id]) }}">
                @csrf
                <button class="rtable-link" type="submit">
                  <img src="{{ asset('images/icons/icon-activate.svg') }}" class="rtable-icon" alt="Icono de activar" title="Activar" width="22">
                  <span class="rtable-span">Activar</span>
                </button>
              <form/>
            @else
              <form id="deleteForm" action="{{ route('tenant.deleteUser', ['usuario_id' => $usuario->user_id]) }}">
                @method("DELETE")
                @csrf
                <button class="rtable-link" type="submit">
                  <img src="{{ asset('images/icons/icon-disabled.svg') }}" class="rtable-icon" alt="Icono de desactivar" title="Desactivar" width="20">
                  <span class="rtable-span">Desactivar</span>
                </button>
              </form>
            @endif
          </div>
        </div>
        @endforeach
        {{ $usuarios->links() }}
      </div>
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
        text: "Se desactivará este empleado",
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
        text: "Se activará este empleado",
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
      'El empleado se ha registrado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('editar') === 'ok')
  <script>
    Swal.fire(
      'Editado!',
      '¡El empleado se ha editado correctamente!',
      'success'
    )
  </script>
@endif

@if (session('eliminar') === 'ok')
  <script>
    Swal.fire(
      'Desactivado!',
      '¡El empleado se ha desactivado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('activar') === 'ok')
  <script>
    Swal.fire(
      'Activado!',
      '¡El empleado se ha activado con éxito!',
      'success'
    )
  </script>
@endif
@endsection()