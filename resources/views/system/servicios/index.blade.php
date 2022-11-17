@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table-responsive.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="service">
  <div class="service-first">
    <div class="service-title">
      <img src="{{ asset('images/icons/icon-servicios_black.svg') }}" class="nav-icon" alt="Icono de servicios" title="Icono de servicios" width="24">
      <h2>Productos y/o Servicios</h2>
    </div>
    <a href="{{ route('tenant.showRegisterServicio') }}" class="service-button">
      <span>+</span>
      <span>Nuevo registro</span>
    </a>
  </div>
  @if (count($productosServicios) <= 0)
    <div class="service-second">
      <img src="{{ asset('images/illustrations/services.svg') }}" alt="Servicios" title="No hay productos y/o servicios registrados" width="250">
      <p>No hay productos y/o servicios registrados</p>
    </div>
  @else
    <div class="rtable">
      <div class="rtable-head">
        <p class="rtable-col rtable-id">ID</p>
        <p class="rtable-col rtable-image">Imagen</p>
        <p class="rtable-col rtable-name">Nombre</p>
        <p class="rtable-col rtable-description">Descripción</p>
        <p class="rtable-col rtable-price">Precio</p>
        <p class="rtable-col rtable-type">Tipo</p>
        <p class="rtable-col rtable-actions">Acciones</p>
      </div>
      <div class="rtable-body">
        @foreach ($productosServicios as $servicio)
          <div class="rtable-row">
            <p class="rtable-item rtable-id">{{$servicio->producto_servicio_id}}</p>
            <img class="rtable-image" src="{{asset("images/productos_servicios/$servicio->imagen")}}" alt="Imagen de Laptop" width="100">
            <p class="rtable-item rtable-name">{{$servicio->nombre}}</p>
            <p class="rtable-item rtable-description">{!! $servicio->descripcion !!}</p>
            <p class="rtable-item rtable-price">${{$servicio->precio_bruto}}</p>
            @if($servicio->tipo->nombre_tipo === "Producto")         
              <p class="rtable-item rtable-type isProduct">{{Str::ucfirst($servicio->tipo->nombre_tipo)}}</p>
            @else
              <p class="rtable-item rtable-type isService">{{Str::ucfirst($servicio->tipo->nombre_tipo)}}</p>    
            @endif
            <div class="rtable-group rtable-actions">
              <a class="rtable-link" href="{{ route('tenant.showServicio', $servicio) }}">
                <img src="{{ asset('images/icons/icon-eye.svg') }}" class="rtable-icon" alt="Icono de ver" title="Ver" width="22">
                <span class="rtable-span">Ver</span>
              </a>
              <a class="rtable-link" href="{{ route('tenant.showEditServicio', $servicio) }}">
                <img src="{{ asset('images/icons/icon-edit.svg') }}" class="rtable-icon" alt="Icono de editar" title="Editar" width="22">
                <span class="rtable-span">Editar</span>
              </a>
              @if ($servicio->deleted_at != NULL)
                <form id="activateForm" action="{{ route('tenant.activateServicio', ['servicio_id' => $servicio->producto_servicio_id]) }}">
                  @csrf
                  <button class="rtable-link" type="submit">
                    <img src="{{ asset('images/icons/icon-activate.svg') }}" class="rtable-icon" alt="Icono de activar" title="Activar" width="22">
                    <span class="rtable-span">Activar</span>
                  </button>
                <form/>
              @else
                <form id="deleteForm" action="{{ Route('tenant.deleteServicio', ['servicio_id' => $servicio->producto_servicio_id]) }}">
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
        text: "Se desactivará este producto y/o servicio",
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
        text: "Se activará este producto y/o servicio",
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
      'El producto y/o servicio se ha registrado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('editar') === 'ok')
  <script>
    Swal.fire(
      'Editado!',
      'El producto y/o servicio se ha editado correctamente!',
      'success'
    )
  </script>
@endif

@if (session('eliminar') === 'ok')
  <script>
    Swal.fire(
      'Desactivado!',
      'El producto y/o servicio se ha desactivado con éxito!',
      'success'
    )
  </script>
@endif

@if (session('activar') === 'ok')
  <script>
    Swal.fire(
      'Activado!',
      'El producto y/o servicio se ha activado con éxito!',
      'success'
    )
  </script>
@endif
@endsection()