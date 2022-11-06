@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Crear Cotización') }}</div>

        <div class="card-body">

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
          Registrar Cliente
          </button>

          <!-- Modal -->
          <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" id="añadirUsuario">
                  @csrf
                  <div class="modal-body">
                    @include('layouts.partials.tenant._registroCliente')
                  </div>
                  <div class="modal-footer">
                    <button id="closeModalCliente" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalServicio">
            Registrar Servicio
          </button>

          <!-- Modal de Producto y/o Servicio -->
          <div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Registrar Producto y/o Servicio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" id="añadirServicio" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    @include('layouts.partials.tenant._registroServicio')
                  </div>
                  <div class="modal-footer">
                    <button id="closeModalServicio" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnAñadirServicio" class="btn btn-primary">Registrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <form method="POST" action="{{ route('tenant.cotizacion') }}">
            @csrf
            @method('post')

            {{-- Cliente --}}
            <div class="form-group row justify-content-center">
              <div class="col-md-6">
                <label for="cliente">Buscar cliente</label>
                <div class="input-group">
                    <input type="search" name="cliente" id="cliente" class="form-control @error('cliente') is-invalid @enderror" value="{{old('cliente')}}" placeholder="cliente@cliente.com" aria-label="Search">
                    <span class="input-group-btn">
                      <button type="button" id="selectCliente" class="btn btn-primary">
                        Seleccionar
                      </button>
                    </span>
                    @error('cliente')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
              </div>
            </div>

            <div class="row justify-content-center">

              {{-- ID --}}
              <div class="col-md-4 my-3" style="display: none;">
                <label for="cliente_id" class="form-label">ID Cliente</label>
                <div class="form-group">
                  <input type="text" readonly class="form-control" id="cliente_id" name="cliente_id" value="{{old('cliente_id')}}">
                </div>
              </div>

              {{-- Nombre --}}
              <div class="col-md-4 my-3">
                <label for="nombreCliente" class="form-label">Nombre Cliente</label>
                <div class="form-group">
                  <input type="text" readonly class="form-control @error('nombreCliente') is-invalid @enderror" id="nombreCliente" name="nombreCliente" value="{{old('nombreCliente')}}">
                  @error('nombreCliente')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
  
              {{-- Correo --}}
              <div class="col-md-4 my-3">
                <label for="correoCliente" class="form-label">Correo Cliente</label>
                <div class="form-group">
                  <input type="text" readonly class="form-control @error('correoCliente') is-invalid @enderror" id="correoCliente" name="correoCliente" value="{{old('correoCliente')}}">
                  @error('correoCliente')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

            </div>

            {{-- Nombre de la Cotización --}}
            <div class="form-group row">
              <label for="nombre_cotizacion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la cotización') }}</label>

              <div class="col-md-6">
                <input id="nombre_cotizacion" type="text" class="form-control @error('nombre_cotizacion') is-invalid @enderror" name="nombre_cotizacion" value="{{ old('nombre_cotizacion') }}" autocomplete="nombre_cotizacion" autofocus>

                @error('nombre_cotizacion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Descripcion --}}
            <div class="form-group row">
              <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

              <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" autocomplete="text" autofocus>

                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Fecha de creación --}}
            <div class="form-group row">
              <label for="fecha_creacion" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de creación') }}</label>

              <div class="col-md-6">
                <input id="fecha_creacion" type="date" class="form-control @error('fecha_creacion') is-invalid @enderror" name="fecha_creacion" value="<?php echo date("Y-m-d"); ?>"  autocomplete="fecha_creacion" autofocus required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>

                @error('fecha_creacion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Vigencia --}}
            <div class="form-group row">
              <label for="vigencia" class="col-md-4 col-form-label text-md-right">{{ __('Vigencia (Días)') }}</label>

              <div class="col-md-6">
                <input id="vigencia" type="number" class="form-control @error('vigencia') is-invalid @enderror" name="vigencia" value="{{ old('vigencia') }}" autocomplete="vigencia" autofocus>

                @error('vigencia')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            {{-- Estatus de Cotización --}}
            <div class="form-group row">
              <label for="estatus_cotizacion_id" class="col-md-4 col-form-label text-md-right">{{ __('Estatus de la cotización') }}</label>

              <div class="col-md-6">
                <select name="estatus_cotizacion_id" id="estatus_cotizacion_id" class="form-control estatus_cotizacion_id @error('estatus_cotizacion_id') is-invalid @enderror" autofocus>
                  
                  <option selected disabled value="">Selecciona el status</option>
                  @foreach($estatus as $estatu)
                    @if (old('estatus_cotizacion_id') == $estatu->estatus_cotizacion_id)
                      {{-- {{dd("Algo")}} --}}
                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                      @continue
                    @endif
                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                  @endforeach
                  
                </select>
                @error('estatus_cotizacion_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Producto y/o Servicio --}}
            <div class="form-group row">
              <label for="servicio" class="col-md-4 col-form-label text-md-right">{{ __('Buscar Producto y/o Servicio') }}</label>

              <div class="col-md-6 input-group">
                <input id="servicio" type="search" class="form-control @error('servicio') is-invalid @enderror" name="servicio" value="{{ old('servicio') }}" autocomplete="servicio" autofocus aria-label="Search">
                <span class="input-group-btn">
                  <button type="button" id="selectServicio" class="btn btn-primary">
                      Seleccionar
                  </button>
                </span>
                @error('servicio')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row justify-content-center">
              
              {{-- producto_servicio_id --}}
              <div class="col-md-2">
                <label for="servicio_id" class="form-label">{{ __('ID') }}</label>
                <div class="form-group">
                    <input type="text" readonly class="form-control" id="servicio_id" name="servicio_id" value="{{old('servicio_id')}}">
                    @error('servicio_id')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>

              {{-- Nombre --}}
              <div class="col-md-5">
                <label for="nombre_serv" class="form-label">{{ __('Nombre') }}</label>
                <div class="form-group">
                    <input type="text" readonly class="form-control" id="nombre_serv" name="nombre_serv" value="{{old('nombre_serv')}}">
                    @error('nombre_serv')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>

              {{-- Descripción --}}
              <div class="col-md-5">
                <label for="descripcion_cotizacion" class="form-label">{{ __('Descripción') }}</label>
                <div class="form-group">
                    <input type="text" readonly class="form-control" id="descripcion_cotizacion" name="descripcion_cotizacion" value="{{old('descripcion_cotizacion')}}">
                    @error('descripcion_cotizacion')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>
            </div>

            <div class="row justify-content-center">

              {{-- Tipo --}}
              <div class="col-md-4">
                <label for="tipo" class="form-label">{{ __('Tipo') }}</label>
                <div class="form-group">
                    <input type="text" readonly class="form-control" id="tipo" name="tipo" value="{{old('tipo')}}">
                    @error('tipo')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>

              {{-- Precio --}}
              <div class="col-md-4">
                <label for="precio" class="form-label">{{ __('Precio') }}</label>
                <div class="form-group">
                    <input type="text" class="form-control  @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{old('precio')}}">
                    @error('precio')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>
  
              {{-- Descuento --}}
              <div class="col-md-2">
                <label for="descuento" class="form-label">{{ __('Descuento (porcentaje)') }}</label>
                <div class="form-group">
                    <input type="number" value="0" class="form-control @error('descuento') is-invalid @enderror" id="descuento" name="descuento" value="{{old('descuento')}}" min="0" max="100" step="1" onkeyup="validarDescuento(this)"/>
                    @error('descuento')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>

              {{-- Cantidad --}}
              <div class="col-md-2">
                <label for="cantidad" class="form-label">{{ __('Cantidad') }}</label>
                <div class="form-group">
                    <input type="number" value="1" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{old('cantidad')}}" min="1" max="1000" step="1" onkeyup="validarNumero(this)"/>
                    @error('cantidad')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
              </div>
            </div>

            {{-- CTA-Agregar --}}
            <div class="form-group row mb-5">
              {{-- <div class="col-md-6 offset-md-4"> --}}
              <div class="col">
                <button type="button" id="btn_add" class="btn btn-block btn-primary">
                  {{ __('Agregar') }}
                </button>
              </div>
            </div>

            {{-- Productos/Servicios cotizados --}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="table-responsive">
                <table id="detalles" name="servicio_uuid" class="table table-striped table-bordered condensed table-hover @error('servicio_uuid') is-invalid @enderror">
                  <thead class="thead-dark">
                    <th>ID servicio</th>
                    <th>Nombre servicio</th>
                    <th>Precio inicial</th>
                    <th>Descuento</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </thead>
                  <tfoot>
                    <tr>
                      <td colspan="8">
                        <div class="form-group d-flex mb-0">
                          <label for="descuento_general" class="form-label">{{ __('Descuento general (porcentaje)') }}</label>
                          <input type="number" value="0" class="form-control descuento_general @error('descuento_general') is-invalid @enderror" id="descuento_general" name="descuento_general" value="{{old('descuento_general')}}" min="0" max="100" step="1" onkeyup="validarDescuento(this)"/>
                          
                          @error('descuento_general')
                          <small class="text-danger">{{$message}}</small>
                          @enderror
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5">Total</td>
                      <td>
                          <h4 id="total_inicial" name="total_inicial">$0.00</h4>
                      </td>
                      <td>
                          <h4 id="total_iva" name="total_iva">$0.00</h4>
                      </td>
  
                      <td>
                          <h4 id="total_total" name="total_total">$0.00</h4>
                      </td>
                    </tr>
                  </tfoot>
                </table>
                @error('servicio_uuid')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            {{-- CTA Cotizar --}}
            <div class="col-md-12" id="cotizar">
              <button type="submit" class="btn btn-primary">Cotizar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Condicional para mostrar alerta de que no se pudo cotizar --}}
@if (session('sinProductos') === 'yes'){
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'No se ha agregado nada para cotizar',
    })
  </script>
} 
@endif

<script>

function validarNumero(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 1){
    $(value).val(valor);
  }else{
    $(value).val(1);
  }
}

function validarPrecio(value) {
  let valor = $(value).val();
  if (isNaN(valor) || valor <= 0){
    $(value).val("");
  }
}

function validarDescuento(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 0 && valor<=100){
    $(value).val(valor);
  }else{
    $(value).val(0);
  }
}

$(document).ready(function () {
  
  $("#cliente").autocomplete({
    source: function(request, response) {
      let _token = $("input[name=_token]").val();
      $.ajax({
        url: "{{route('tenant.buscarCliente')}}",
        type: 'POST',
        data: {
          term: request.term,
          _token,
        },
        dataType: 'json',
        success: function(data) {
          let resp = $.map(data, function(obj) {
            return obj.email;
            response(data);
          });
          response(resp);
        }
      })
    },
    minLength: 1,
  })

  $("#selectCliente").click(function() {
    let _token = $("input[name=_token]").val();

    const cliente = $('#cliente').val()
    $.ajax({
      url: "{{route('tenant.seleccionarCliente')}}",
      type: "POST",
      data: {
        cliente: cliente,
        _token,
      },
      success: function(data) {
        if(Object.entries(data).length !== 0){
          $("#cliente_id").val(data.cliente_id ?? "Sin datos")
          $("#nombreCliente").val(data.nombre ?? "Sin datos")
          $("#correoCliente").val(data.email ?? "Sin datos")
        }
      }
    })
  })

  $('#servicio').autocomplete({
    source: function(request, response){
    let _token = $("input[name=_token]").val();

      $.ajax({
        url: "{{route('tenant.buscarServicio')}}",
        type: "POST",
        data: {
          term: request.term,
          _token
        },
        dataType: 'json',
        success: function(data){
          let resp = $.map(data, function(obj){
            return obj.nombre;
            response(data);
          });
          response(resp);
        }
      })
    },
    minLength: 1,
  });

  $("#selectServicio").click(function() {
    let _token = $("input[name=_token]").val();

    const servicio = $('#servicio').val()
    $.ajax({
      url: "{{route('tenant.seleccionarServicio')}}",
      type: "POST",
      data: {
        servicio: servicio,
        _token
      },
      success: function(data) {
        if(Object.entries(data).length !== 0){
          let tiposPHP = '<?= json_encode($tipos) ?>'
          let tiposJson = JSON.parse(tiposPHP)
          let tipo_id = data.tipo_id
          let tipoDePS = tiposJson.filter((tipo) => {
            return tipo.tipo_id === tipo_id;
          })
  
          let tipoDelPS;
  
          tipoDelPS = (tipoDePS[0]) ? tipoDePS[0].nombre_tipo : "No definido";
          
          $("#servicio_id").val(data.producto_servicio_id ?? "Sin datos")
          $("#nombre_serv").val(data.nombre ?? "Sin datos")
          $("#descripcion_cotizacion").val(data.descripcion ?? "Sin datos")
          $("#tipo").val(tipoDelPS ?? "Sin datos")
          $("#precio").val(data.precio_bruto ?? "Sin datos") 
        }
        // Swal.fire({
        //   icon: 'error',
        //   title: 'Error...',
        //   text: 'No se ha seleccionado nada!',
        // })
      }
    });
  });

  // añadirUsuario
  $("#añadirUsuario").submit(function(e){
    e.preventDefault(); 

    let nombre = $("#nombre").val();
    let apep = $("#apep").val();
    let apm = $("#apm").val();
    let direccion = $("#direccion").val();
    let telefono = $("#telefono").val();
    let correo = $("#correo").val();
    let contraseña = $("#contraseña").val();
    let confirmar_contraseña = $("#confirmar_contraseña").val();
    let _token = $("input[name=_token]").val();


    // console.log({
    //   nombre, app, apm, direccion, telefono, correo, contraseña, confirmar_contraseña, _token
    // }); 

    $.ajax({
      url: "{{route('tenant.registrarCliente')}}",
      type: 'POST',
      data: {
        nombre, 
        apep, 
        apm, 
        direccion, 
        telefono, 
        correo, 
        contraseña, 
        confirmar_contraseña, 
        _token
      },
      dataType: 'json',
      success: function(response) {

        limpiarMensajesErrorCliente();

        if (response.errors) {
          for (const prop in response.errors) {
            $(`#${prop} + span#${prop}-error`).css('display','block');
            $(`#${prop} + span#${prop}-error > strong`).text(response.errors[prop][0])
          }
        }else{
          limpiarCajasCliente()

          $("#modal .close").click()
        }
      }
    })
  });

  $('#closeModalCliente').click(function() {
    limpiarMensajesErrorCliente();
    limpiarCajasCliente();
  });

  function limpiarMensajesErrorCliente(){
    $(`span#nombre-error`).css('display','none');
    $(`span#apep-error`).css('display','none');
    $(`span#apm-error`).css('display','none');
    $(`span#direccion-error`).css('display','none');
    $(`span#telefono-error`).css('display','none');
    $(`span#correo-error`).css('display','none');
    $(`span#contraseña-error`).css('display','none');
    $(`span#confirmar_contraseña-error`).css('display','none');
  }

  function limpiarCajasCliente(){
    $("#nombre").val("");
    $("#apep").val("");
    $("#apm").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#correo").val("");
    $("#contraseña").val("");
    $("#confirmar_contraseña").val("");
  }

  $('#closeModalServicio').click(function(){
    limpiarMensajesErrorServicio();
    limpiarCajasServicio();
  })

  function limpiarMensajesErrorServicio(){
    $(`span#nombreServicio-error`).css('display','none');
    $(`span#descripcionServicio-error`).css('display','none');
    $(`span#codigoServicio-error`).css('display','none');
    $(`span#imagenServicio-error`).css('display','none');
    $(`span#precioServicio-error`).css('display','none');
    $(`span#tipoServicio-error`).css('display','none');
    $(`span#unidadServicio-error`).css('display','none');
  }

  function limpiarCajasServicio(){
    $("#nombreServicio").val("");
    $("#descripcionServicio").val("");
    $("#codigoServicio").val("");
    $("#imagenServicio").val("");
    $("#precioServicio").val("");
    $("#tipoServicio").val("");
    $("#unidadServicio").val("");
  }

  // añadirServicio
  $("#añadirServicio").submit(function(e){
    e.preventDefault(); 

    let parametros = new FormData($("#añadirServicio")[0]);

    let nombreServicio = $("#nombreServicio").val();
    let descripcionServicio = $("#descripcionServicio").val();
    let codigoServicio = $("#codigoServicio").val();
    let precioServicio = $("#precioServicio").val();
    let tipoServicio = $("#tipoServicio").val();
    let unidadServicio = $("#unidadServicio").val();
    let _token = $("input[name=_token]").val();
    
    $.ajax({
      url: "{{route('tenant.registrarServicio')}}",
      type: 'POST',
      data: parametros,
      contentType: false,
      processData: false,
      success: function(response) {
        limpiarMensajesErrorServicio()

        if (response.errors) {
          for (const prop in response.errors) {
            $(`#${prop} + span#${prop}-error`).css('display','block');
            $(`#${prop} + span#${prop}-error > strong`).text(response.errors[prop][0])
          }
        }else{
          limpiarCajasServicio()

          $("#modalServicio .close").click()
        }
      }
    })
  });

  let arrayServicios = [];
  let arrayCostosFinales = [];

  function agregarProducto(){
    let nombre = $('#nombre_serv').val();
    let servicioId = $('#servicio_id').val();
    let precioInicial = $('#precio').val();
    let numeroServicios = $('#cantidad').val();
    let descuento = $('#descuento').val();
    let _descuento = descuento;
    descuento = descuento == 100 ? 1 : (descuento < 10) ? `0.0${descuento}` : `0.${descuento}`;

    let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
    let precioBruto2 = precioBruto;
    precioBruto = descuento > 0 ? ((precioBruto2 - (precioBruto2 * Number(descuento)))).toFixed(2) : precioBruto2;

    let precioIva = (Number(precioBruto) * .16).toFixed(2);
    let subtotal = (Number(precioIva) + parseFloat(precioBruto)).toFixed(2);

    let UUID = generarUUID();

    arrayServicios.push({
      servicioId,
      UUID,
      numeroServicios,
      _descuento,
      precioBruto: precioBruto,
      precioIva: precioIva,
      subtotal: subtotal,
    });

    const fila = `<tr id="fila"> 
      <td><input class="form-control" type="number" id="servicio_id" name="servicio_id[]" value="${servicioId}" readonly></td>
      <td style="display: none;"><input class="form-control" type="text" id="servicio_uuid" name="servicio_uuid[]" data-uuid="${UUID}" value="${UUID}" readonly></td>
      <td><input class="form-control" type="text" id="nombre" name="nombre[]" value="${nombre}" readonly></td>r
      <td><input class="form-control" type="number" id="precio_inicial" name="precio_inicial[]" value="${precioInicial}" readonly></td>
      <td><input class="form-control" type="number" id="descuento_aplicado" name="descuento_aplicado[]" value="${_descuento}" readonly></td>
      <td><input class="form-control number" type="number" id="number" name="numero_servicios[]" value="${numeroServicios}" min="1"></td>
      <td><input class="form-control" type="text" id="precio_bruto" name="precio_bruto[]" value="${precioBruto}" readonly></td>
      <td><input class="form-control" type="text" id="precio_iva" name="precio_iva[]" value="${precioIva}" readonly></td>
      <td><input class="form-control" type="number" id="subtotal" name="subtotal[]" value="${subtotal}" readonly></td> 
      <td><button type="button" class="btn btn-danger delete" value="Eliminar">X</button></td>
      </tr>; `

    limpiarCampos();
    $('#detalles').append(fila);

    $(".number").bind("keyup keydown change", function(){
      let fila = $(this).closest("#fila");
      calcularCostos(fila);
    });

    let {
      inicial,
      iva,
      total
    } = sumarCostosFinal(arrayServicios);
    
    $("#total_inicial").html("$" + inicial);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);

    // let UUIDC = generarUUID();

    // arrayCostosFinales.push({
    //   UUIDC,
    //   inicial,
    //   iva,
    //   total,
    // });

    // sumarCostosFinal(arrayCostosFinales);
  }

  function sumarCostos(array){
    let inicial = 0;
    let iva = 0;
    let total = 0;

    array.forEach((el) => {
      inicial += Number(el.precioBruto),
      iva += Number(el.precioIva),
      total += Number(el.subtotal)
    })

    return {
      inicial: inicial.toFixed(2),
      iva: iva.toFixed(2),
      total: total.toFixed(2)
    }
  }

  $(".descuento_general").bind("keyup keydown change", function(){
    if (arrayServicios.length > 0) {
      let {
        inicial,
        iva,
        total
      } = sumarCostosFinal(arrayServicios);
      
      $("#total_inicial").html("$" + inicial);
      $("#total_iva").html("$" + iva);
      $("#total_total").html("$" + total);
    }
  });

  function sumarCostosFinal(array){

    let inicialC = 0;
    let ivaC = 0;
    let totalC = 0;

    let inicialDescuento = 0;
    let ivaDescuento = 0;
    let totalDescuento = 0;

    let descuentoGeneral = $("#descuento_general").val();
    descuentoGeneral = descuentoGeneral == 100 ? 1 : (descuentoGeneral < 10) ? `0.0${descuentoGeneral}` : `0.${descuentoGeneral}`;

    array.forEach((costo) => {
      inicialC += Number(costo.precioBruto),
      ivaC += Number(costo.precioIva),
      totalC += Number(costo.subtotal)
    })

    inicialDescuento = inicialC;
    ivaDescuento = ivaC;
    totalDescuento = totalC;

    inicialC = descuentoGeneral > 0 ? ((inicialDescuento - (inicialDescuento * Number(descuentoGeneral)))) : inicialDescuento;
    ivaC = descuentoGeneral > 0 ? ((ivaDescuento - (ivaDescuento * Number(descuentoGeneral)))): ivaDescuento;
    totalC = descuentoGeneral > 0 ? ((totalDescuento - (totalDescuento * Number(descuentoGeneral)))) : totalDescuento;

    return {
      inicial: inicialC.toFixed(2),
      iva: ivaC.toFixed(2),
      total: totalC.toFixed(2)
    }
  }

  function calcularCostos(fila){
    let servicioId = $(fila).find('td > input#servicio_id').val();
    let UUID = $(fila).find('td > input#servicio_uuid').data("uuid")
    let precioInicial = $(fila).find('td > input#precio_inicial').val();
    let numeroServicios = $(fila).find('td > input#number').val();
    let descuento = $(fila).find('td > input#descuento_aplicado').val();
    let _descuento = descuento;
    descuento = descuento == 100 ? 1 : (descuento < 10) ? `0.0${descuento}` : `0.${descuento}`;
    
    let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
    let precioBruto2 = precioBruto;
    precioBruto = descuento > 0 ? ((precioBruto2 - (precioBruto2 * Number(descuento)))).toFixed(2) : precioBruto2;
    
    let precioIva = (Number(precioBruto) * .16).toFixed(2);
    let subtotal = (Number(precioIva) + parseFloat(precioBruto)).toFixed(2);
    
    $(fila).find('td > input#precio_bruto').val(precioBruto);
    $(fila).find('td > input#precio_iva').val(precioIva);
    $(fila).find('td > input#subtotal').val(subtotal);

    arrayServicios = arrayServicios.filter((el => el.UUID !== UUID));

    arrayServicios.push({
      servicioId,
      UUID,
      numeroServicios,
      _descuento,
      precioBruto,
      precioIva,
      subtotal,
    });

    let {
      inicial,
      iva,
      total
    } = sumarCostos(arrayServicios);
    
    $("#total_inicial").html("$" + inicial);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);
  }

  function generarUUID() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxxxxxx7xxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
    // var uuid = 'x7y'.replace(/[xy]/g, function (c) {
      var r = (d + Math.random() * 16) % 16 | 0;
      d = Math.floor(d / 16);
      return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });

    return uuid;
  }

  function limpiarCampos(){
    $("#servicio").val("");
    $("#servicio_id").val("");
    $("#nombre_serv").val("");
    $("#descripcion_cotizacion").val("");
    $("#tipo").val("");
    $("#precio").val("");
    $("#cantidad").val(1);
    $("#descuento").val(0);
  }

  function validarProductoServicio(){
    let servicio_id = $("#servicio_id").val();
    let nombre = $("#nombre_serv").val();
    let descripcion = $("#descripcion_cotizacion").val();
    let tipo = $("#tipo").val();
    let precio = $("#precio").val();
    let descuento = $("#descuento").val();
    let cantidad = $("#cantidad").val();

    if(servicio_id && nombre && descripcion && tipo && precio && descuento && cantidad){
      agregarProducto();
    }else{
      Swal.fire({
        icon: 'error',
        title: 'Error...',
        text: 'Faltan datos por registrar!',
      })
    }
  }

  $('#btn_add').click(function(){
    validarProductoServicio();
    // console.log("Click");
  });

  $(document).on('click', '.delete', function(event) {
    let inputUUID = $(this).closest('tr')[0].getElementsByTagName('td')[1].getElementsByTagName('input')[0];
    let UUID = $(inputUUID).data("uuid")

    arrayServicios = arrayServicios.filter((el => el.UUID !== UUID));
    $(this).closest('tr').remove();

    let {
      inicial,
      iva,
      total
    } = sumarCostosFinal(arrayServicios);
    
    $("#total_inicial").html("$" + inicial);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);
  });
});

</script>

@endsection