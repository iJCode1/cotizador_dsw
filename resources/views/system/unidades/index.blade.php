@extends('layouts.app')

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
</div>

{{-- Script para mostrar alertas --}}
<script>

  const d = document;

  // Alerta al querer eliminar un registro
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

  // Alerta al querer activar un registro
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

{{-- Condicional para mostrar alerta de producto y/o servicio creado --}}
@if (session('crear') === 'ok')
  <script>
    Swal.fire(
      'Registrado!',
      '¡La unidad se ha registrado con éxito!',
      'success'
    )
  </script>
@endif

{{-- Condicional para mostrar alerta de editado --}}
@if (session('editar') === 'ok')
  <script>
    Swal.fire(
      'Editado!',
      '¡La unidad se ha editado correctamente!',
      'success'
    )
  </script>
@endif

{{-- Condicional para mostrar alerta de eliminado --}}
@if (session('eliminar') === 'ok')
  <script>
    Swal.fire(
      'Desactivado!',
      '¡La unidad se ha desactivado con éxito!',
      'success'
    )
  </script>
@endif

{{-- Condicional para mostrar alerta de activado --}}
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