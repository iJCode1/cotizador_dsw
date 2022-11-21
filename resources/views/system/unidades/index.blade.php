@extends('layouts.app')

@section('title')
  <title>Unidades</title>
@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('css/unidades.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- @if ( count($unidades) <= 0)
  <p>No hay unidades</p>
@else
  <p>Si hay unidades</p>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre de la Unidad</th>
        <th scope="col">Abreviación</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($unidades as $unidad)
        <tr>
          <th scope="row">{{$unidad->unidad_medida_id}}</th>
          <td>{{$unidad->nombre_unidad}}</td>
          <td>{{$unidad->abrev}}</td>
          <td>
            <a href="{{ route('tenant.showEditUnidad', $unidad) }}" class="btn btn-warning">Editar</a>
          </td>
          <td>
            @if ($unidad->deleted_at != NULL)
              <form id="activateForm" action="{{ route('tenant.activateUnidad', ['unidad_id' => $unidad->unidad_medida_id]) }}">
                @csrf
                <button type="submit" class="btn btn-info text-white">Activar</button>
              </form>
            @else
              <form id="deleteForm" action="{{ route('tenant.deleteUnidad', ['unidad_id' => $unidad->unidad_medida_id]) }}">
                @method("DELETE")
                @csrf
                <button type="submit" class="btn btn-danger">Desactivar</button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif --}}
<div class="unit">
  <div class="unit-first">
    <div class="unit-title">
      <img src="{{ asset('images/icons/icon-unidad.svg') }}" class="nav-icon" alt="Icono de unidades de medida" title="Icono de unidades de medida" width="26">
      <h2>Unidades de medida</h2>
    </div>
    <a href="{{ route('tenant.showRegisterUnidad') }}" class="unit-button">
      <span>+</span>
      <span>Nuevo registro</span>
    </a>
  </div>
  @if (count($unidades) <= 0)
    <div class="unit-second">
      <img src="{{ asset('images/illustrations/unit.svg') }}" alt="Unidades de medida" title="No hay unidades de medida registradas" width="250">
      <p>No hay unidades de medida</p>
    </div>
  @else
  <div class="rtable">
    <div class="rtable-head">
      <p class="rtable-col rtable-id">ID</p>
      <p class="rtable-col rtable-name">Nombre</p>
      <p class="rtable-col rtable-abrev">Abreviación</p>
      <p class="rtable-col rtable-actions">Acciones</p>
    </div>
    <div class="rtable-body">
      @foreach ($unidades as $unidad)
        <div class="rtable-row">
          <p class="rtable-item rtable-id">{{$unidad->unidad_medida_id}}</p>
          <p class="rtable-item rtable-name">{{$unidad->nombre_unidad}}</p>
          <p class="rtable-item rtable-abrev">{{$unidad->abrev}}</p>
          <div class="rtable-group rtable-actions">
            <a class="rtable-link" href="{{ route('tenant.showEditUnidad', $unidad) }}">
              <img src="{{ asset('images/icons/icon-edit.svg') }}" class="rtable-icon" alt="Icono de editar" title="Editar" width="22">
              <span class="rtable-span">Editar</span>
            </a>
            @if ($unidad->deleted_at != NULL)
              <form id="activateForm" action="{{ route('tenant.activateUnidad', ['unidad_id' => $unidad->unidad_medida_id]) }}">
                @csrf
                <button class="rtable-link" type="submit">
                  <img src="{{ asset('images/icons/icon-activate.svg') }}" class="rtable-icon" alt="Icono de activar" title="Activar" width="22">
                  <span class="rtable-span">Activar</span>
                </button>
              <form/>
            @else
              <form id="deleteForm" action="{{ route('tenant.deleteUnidad', ['unidad_id' => $unidad->unidad_medida_id]) }}">
                @method("DELETE")
                @csrf
                <button class="rtable-link" type="submit">
                  <img src="{{ asset('images/icons/icon-disabled.svg') }}" class="rtable-icon" alt="Icono de desactivar" title="Desactivar" width="22">
                  <span class="rtable-span">Desactivar</span>
                </button>
              </form>
            @endif
          </div>
        </div>
        @endforeach
        {{ $unidades->links() }}
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
        text: "Se desactivará esta unidad de medida",
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
        text: "Se activará esta unidad de medida",
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
      '¡La unidad se ha registrado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('editar') === 'ok')
  <script>
    Swal.fire(
      'Editado!',
      '¡La unidad se ha editado correctamente!',
      'success'
    )
  </script>
@endif

@if (session('eliminar') === 'ok')
  <script>
    Swal.fire(
      'Desactivado!',
      '¡La unidad se ha desactivado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('activar') === 'ok')
  <script>
    Swal.fire(
      'Activado!',
      '¡La unidad se ha activado con éxito!',
      'success'
    )
  </script>
@endif

@endsection