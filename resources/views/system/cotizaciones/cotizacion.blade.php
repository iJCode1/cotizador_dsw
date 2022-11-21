@extends('layouts.app')

@section('title')
  <title>Cotización</title>
@endsection

@section('css')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  <link href="{{ asset('css/register.css') }}" rel="stylesheet">
  <link href="{{ asset('css/servicios.css') }}" rel="stylesheet">
  <link href="{{ asset('css/cotizaciones.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="quotation">
  <div class="quotation-first quotation-concept">
    <div class="quotation-title">
      <img src="{{ asset('images/icons/icon-cotizaciones_black.svg') }}" class="nav-icon" alt="Icono de cotizaciones" title="Icono de cotizaciones" width="24">
      <h2>{{ __('Realizar cotización') }}</h2>
    </div>
  </div>
  <form class="quotation-form" method="POST" action="{{ route('tenant.cotizacion') }}">
    @csrf
    @method('post')

    <div>

      <div class="quotation-fFirst">
        <div @if($usuario === "cliente") class="data-readonly" @endif>
          <p class="form-concept">Información del Cliente</p>
          <div class="form-inputs">
            @if ($usuario === "interno")
              <div class="inputs-search">
                <div class="register-data">
                  <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
                  <div class="register-input register-search">
                    <div class="input-group">
                      <label for="cliente">{{ __('Buscar cliente (por email)') }}</label>
                      <input type="search" name="cliente" id="cliente" value="{{old('cliente')}}" placeholder="example@cliente.com" aria-label="Search">
                    </div>
                    <span class="input-group-btn">
                      <button type="button" id="selectCliente" class="form-cta select-cta">
                        Seleccionar
                      </button>
                    </span>
      
                    @error('cliente')
                    <span class="invalid-feedbackk" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
    
                <!-- Button trigger modal -->
                <button type="button" class="btn-modal" data-toggle="modal" data-target="#modal">
                  <span>+</span>
                  Registrar Cliente
                </button>
              </div>
    
      
              <!-- Modal -->
              <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
                      <button id="closeModalCliente" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" id="añadirUsuario">
                      @csrf
                      <div class="modal-body modal-padding">
                        @include('layouts.partials.tenant._registroCliente')
                      </div>
                      <div class="modal-footer">
                        <button id="cancelModalCliente" type="button" class="btn-modal btn-cancel" data-dismiss="modal">Cancelar</button>
                        <button id="btnAñadirUsuario" type="submit" class="btn-modal btn-register">Registrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
    
              <div class="register-data data-readonly">
                <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
                <div class="register-input">
                  <label for="cliente_id">{{ __('ID Cliente') }}</label>
                  <input id="cliente_id" type="text" readonly name="cliente_id" value="{{old('cliente_id')}}">
                  
                </div>
              </div>
    
              <div class="register-double">
                <div class="register-data">
                  <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
                  <div class="register-input">
                    <label for="nombreCliente">{{ __('Nombre Cliente') }}</label>
                    <input id="nombreCliente" readonly type="text" name="nombreCliente" value="{{old('nombreCliente')}}">
                    
                    @error('nombreCliente')
                      <span class="invalid-feedbackk" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="register-data">
                  <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
                  <div class="register-input">
                    <label for="correoCliente">{{ __('Correo Cliente') }}</label>
                    <input id="correoCliente" type="email" readonly name="correoCliente" value="{{old('correoCliente')}}">
      
                    @error('correoCliente')
                      <span class="invalid-feedbackk" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            @endif
    
            @if ($usuario === "cliente")
              <div class="register-data">
                <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
                <div class="register-input">
                  <label for="cliente_id">{{ __('ID Cliente') }}</label>
                  <input id="cliente_id" readonly type="text" name="cliente_id" value="{{$cliente->cliente_id}}">
                  
                </div>
              </div>
    
              <div class="register-data">
                <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
                <div class="register-input">
                  <label for="cliente">{{ __('Nombre Cliente') }}</label>
                  <input id="cliente" name="cliente" type="text" readonly value="{{$cliente->nombre}}">
                  
                </div>
              </div>
    
              <div class="register-data">
                <img src="{{ asset('images/icons/icon-person_black.svg') }}" alt="" width="26">
                <div class="register-input">
                  <label for="nombreCliente">{{ __('Nombre Cliente') }}</label>
                  <input id="nombreCliente" type="text" name="nombreCliente" value="{{$cliente->nombre}}">
                  
                </div>
              </div>
    
              <div class="register-data">
                <img src="{{ asset('images/icons/icon-email.svg') }}" alt="" width="26">
                <div class="register-input">
                  <label for="correoCliente">{{ __('Email Cliente') }}</label>
                  <input id="correoCliente" type="email" readonly name="correoCliente" value="{{$cliente->email}}">
                  
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>   
        
      <div class="quotation-fSecond">
        <p class="form-concept">Información de la Cotización</p>
        <div class="form-inputs">
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-folio.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="folio_cotizacion">{{ __('Folio de la cotización') }}</label>
              <input id="folio_cotizacion" type="text" name="folio_cotizacion" value="{{ $folio }}" autocomplete="folio_cotizacion" autofocus readonly>
  
              @error('folio_cotizacion')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
  
          <div class="register-data">
            <img src="{{ asset('images/icons/icon-descripcion.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="descripcion">{{ __('Descripcion') }}</label>
              <textarea id="descripcion" name="descripcion" autofocus rows="2" placeholder="La cotización contiene la solicitud de una Laptop Lenovo i7 para Julian desde la empresa...">{{ old('descripcion') }}</textarea>
  
              @error('descripcion')
              <span class="invalid-feedbackk" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          
          <div class="register-double">
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-calendar.svg') }}" alt="" width="28">
              <div class="register-input">
                <label for="fecha_creacion">{{ __('Fecha de creación') }}</label>
                <input id="fecha_creacion" type="date" name="fecha_creacion" value="<?php echo date("Y-m-d"); ?>"  autocomplete="fecha_creacion" autofocus required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
  
                @error('fecha_creacion')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div @if($usuario === "cliente") class="data-readonly" @else class="register-data" @endif>
              <img src="{{ asset('images/icons/icon-clock.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="vigencia">{{ __('Vigencia (días)') }}</label>
                <input id="vigencia" type="number" name="vigencia" @if($usuario === "cliente") value="7" @else value="{{ old('vigencia') }}" @endif autocomplete="vigencia" min="1" max="365" step="1" autofocus onkeyup="validarVigencia(this)">
                
                @error('vigencia')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
  
          @if ($usuario === "interno")
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-status.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="estatus_cotizacion_id">{{ __('Estatus de la cotización') }}</label>
                <select name="estatus_cotizacion_id" id="estatus_cotizacion_id" autofocus>
                  <option selected disabled value="">Selecciona el status</option>
                  @foreach($estatus as $estatu)
                    @if (old('estatus_cotizacion_id') == $estatu->estatus_cotizacion_id)
                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                      @continue
                    @endif
                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                  @endforeach
                </select>
  
                @error('estatus_cotizacion_id')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          @endif
  
          @if ($usuario === "cliente")
            <div class="register-data data-readonly">
              <img src="{{ asset('images/icons/icon-status.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="estatus_cotizacion_id">{{ __('Estatus de la cotización') }}</label>
                <select name="estatus_cotizacion_id" id="estatus_cotizacion_id" autofocus>
                  <option selected value="1">Enviado</option>
                </select>
              </div>
            </div>
          @endif
        </div>
      </div>
  
      <div class="quotation-fThird">
        <p class="form-concept">Información del Producto y/o Servicio a cotizar</p>
        <div class="form-inputs">
          <div class="inputs-search">
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-servicios_black.svg') }}" alt="" width="26">
              <div class="register-input register-search">
                <div class="input-group">
                  <label for="servicio">{{ __('Buscar Producto y/o Servicio') }}</label>
                  <input id="servicio" type="search" name="servicio" value="{{ old('servicio') }}" autocomplete="servicio" autofocus aria-label="Search">
                </div>
                <span class="input-group-btn">
                  <button type="button" id="selectServicio" class="form-cta select-cta">
                    Seleccionar
                  </button>
                </span>
    
                @error('servicio')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
  
            @if ($usuario === "interno")
              <!-- Button trigger modal -->
              <button type="button" class="btn-modal" data-toggle="modal" data-target="#modalServicio">
                <span>+</span>
                Registrar Servicio
              </button>
  
              <!-- Modal de Producto y/o Servicio -->
              <div class="modal fade" id="modalServicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Registrar Producto y/o Servicio</h5>
                      <button id="closeModalServicio" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" id="añadirServicio" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-body modal-padding">
                        @include('layouts.partials.tenant._registroServicio')
                      </div>
                      <div class="modal-footer">
                        <button id="cancelModalServicio" type="button" class="btn-modal btn-cancel" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnAñadirServicio" class="btn-modal btn-register">Registrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          </div>
  
          <div class="register-double">
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="servicio_id">{{ __('ID') }}</label>
                <input id="servicio_id" readonly type="text" name="servicio_id" value="{{old('servicio_id')}}">
                
                @error('servicio_id')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
  
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-servicios_black.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="nombre_serv">{{ __('Nombre') }}</label>
                <input id="nombre_serv" readonly type="text" name="nombre_serv" value="{{old('nombre_serv')}}">
                
                @error('nombre_serv')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </div>
  
          <div class="register-double">
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-tipo.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="tipo">{{ __('Tipo') }}</label>
                <input id="tipo" readonly type="text" name="tipo" value="{{old('tipo')}}">
                
                @error('tipo')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
  
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-descripcion.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="descripcion_servicio">{{ __('Descripción') }}</label>
                <textarea id="descripcion_servicio" name="descripcion_servicio" readonly autofocus rows="2" placeholder="Una laptop accesible, pero con todo lo que necesitas...">{{ old('descripcion_servicio') }}</textarea>
    
                @error('descripcion_servicio')
                <span class="invalid-feedbackk" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
  
          <div class="register-triple">
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-price.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="precio">{{ __('Precio') }}</label>
                <input id="precio" type="number" name="precio" value="{{old('precio')}}" @if($usuario === "cliente") readonly @endif min="1" step="any" onkeyup="validarPrecio(this)">
                
                @error('precio')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
  
            <div @if($usuario === "cliente") class="register-data data-readonly" @else class="register-data" @endif>
              <img src="{{ asset('images/icons/icon-percent.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="descuento">{{ __('Descuento (porcentaje)') }}</label>
                <input id="descuento" type="number" value="0" name="descuento" value="{{old('descuento')}}" min="0" max="100" step="any" onkeyup="validarDescuento(this)" @if($usuario === "cliente") readonly @endif>
                
                @error('descuento')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
  
            <div class="register-data">
              <img src="{{ asset('images/icons/icon-hash.svg') }}" alt="" width="26">
              <div class="register-input">
                <label for="cantidad">{{ __('Cantidad') }}</label>
                <input id="cantidad" value="1" type="number" name="cantidad" value="{{old('cantidad')}}" min="1" step="1" onkeyup="validarCantidad(this)">
                
                @error('cantidad')
                  <span class="invalid-feedbackk" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            
          </div>
        </div>

        <div class="register-data register-image quotation-image">
          <div class="data-body">
            <img src="{{ asset('images/icons/icon-image.svg') }}" alt="" width="26">
            <div class="register-input">
              <label for="imagen">{{ __('Imagen') }}</label>
            </div>
          </div>
          <div>
            <img class="image-cont" src="#" alt="Imagen del producto y/o servicio" id="img_servicio2" width="250">
          </div>
        </div>
        
        <button type="button" id="btn_add" class="coti-add">
          {{ __('Agregar') }}
        </button>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table id="detalles" name="servicio_uuid" class="table table-striped table-bordered condensed table-hover @error('servicio_uuid') is-invalid @enderror">
            <thead class="text-dark">
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
              <tr @if($usuario === "cliente") class="d-none" @endif>
                <td colspan="8">
                  <div class="form-group d-flex mb-0">
                    <label for="descuento_general" class="form-label">{{ __('Descuento general (porcentaje)') }}</label>
                    <input type="number" value="0" class="form-control descuento_general @error('descuento_general') is-invalid @enderror" id="descuento_general" name="descuento_general" value="{{old('descuento_general')}}" min="0" max="100" step="any" onkeyup="validarDescuento(this)"/>
                    
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
  
      <div class="col-md-12" id="cotizar">
        <button type="submit" class="coti-btn">Cotizar</button>
      </div>
    </div>

  </form>
</div>

@if (session('sinProductos') === 'yes')
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Error...',
      text: 'No se ha agregado nada para cotizar',
    })
  </script>
@endif

<script>

function validarCantidad(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 1){
    $(value).val(parseInt(valor));
  }else{
    $(value).val("");
  }
}

function validarPrecio(value) {
  let valor = $(value).val();
  if (isNaN(valor) || valor <= 0){
    $(value).val("");
  }
}

function validarVigencia(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 1 && valor<=365){
    $(value).val(parseInt(valor));
  }else{
    $(value).val("");
  }
}

function validarDescuento(value) {
  let valor = $(value).val();
  if (isNaN(valor) || valor < 0 || valor > 100){
    $(value).val("");
  }
}

function vistaPreliminar(event){
  let img = new FileReader();
  let img_id = document.getElementById('img_servicio');

  img.onload = () => {
    if(img.readyState == 2){
      img_id.src = img.result;
    }
  }

  img.readAsDataURL(event.target.files[0]);
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
          
          let formatoDescripcion = "Sin datos"
          if(data.descripcion){
            formatoDescripcion = data.descripcion.replace(/<br \/>/g, "");
          }

          $("#servicio_id").val(data.producto_servicio_id ?? "Sin datos")
          $("#nombre_serv").val(data.nombre ?? "Sin datos")
          $("#descripcion_servicio").val(formatoDescripcion ?? "Sin datos")
          $("#tipo").val(tipoDelPS ?? "Sin datos")
          $("#precio").val(data.precio_bruto ?? "Sin datos")
          $("#img_servicio2").attr('src',`images/productos_servicios/${data.imagen}`);
          $("#img_servicio2").removeClass('image-cont')
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
  $("#btnAñadirUsuario").click(function(e){
    e.preventDefault(); 

    let nombre = $("#nombre").val();
    let apep = $("#apep").val();
    let apm = $("#apm").val();
    let direccion = $("#direccion").val();
    let telefono = $("#telefono").val();
    let correo = $("#correo").val();
    let contraseña = $("#contraseña").val();
    let _token = $("input[name=_token]").val();

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

  $('#cancelModalCliente').click(function() {
    limpiarMensajesErrorCliente();
    limpiarCajasCliente();
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
  }

  function limpiarCajasCliente(){
    $("#nombre").val("");
    $("#apep").val("");
    $("#apm").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#correo").val("");
    $("#contraseña").val("");
  }

  $('#cancelModalServicio').click(function(){
    limpiarMensajesErrorServicio();
    limpiarCajasServicio();
  })

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
  $("#btnAñadirServicio").click(function(e){
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
    
    let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
    let precioBruto2 = precioBruto;
    let _ahorro = (precioBruto * descuento) / 100;
    precioBruto = (precioBruto2 - _ahorro).toFixed(2);
    
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
      <td><input class="form-control" type="number" id="descuento_aplicado" name="descuento_aplicado[]" value="${_descuento}" min="0" max="100" step="any" readonly></td>
      <td><input class="form-control number" type="number" id="number" name="numero_servicios[]" value="${numeroServicios}" min="1" step="1" onkeyup="validarCantidad(this)"></td>
      <td><input class="form-control" type="text" id="precio_bruto" name="precio_bruto[]" value="${precioBruto}" readonly></td>
      <td><input class="form-control" type="text" id="precio_iva" name="precio_iva[]" value="${precioIva}" readonly></td>
      <td><input class="form-control" type="number" id="subtotal" name="subtotal[]" value="${subtotal}" readonly></td> 
      <td class="d-flex justify-content-center"><button type="button" class="btn p-0 delete" value="Eliminar">
        <img src="{{ asset('images/icons/icon-trash.svg') }}" class="rtable-icon" alt="Icono de eliminar" title="Eliminar" width="22">
      </button></td>
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

    array.forEach((costo) => {
      inicialC += Number(costo.precioBruto),
      ivaC += Number(costo.precioIva),
      totalC += Number(costo.subtotal)
    })

    inicialDescuento = inicialC;
    ivaDescuento = ivaC;
    totalDescuento = totalC;

    let _ahorro = (inicialDescuento * descuentoGeneral) / 100;
    inicialC = (inicialDescuento - _ahorro).toFixed(2);
    
    ivaC = (Number(inicialC) * .16).toFixed(2);
    totalC = (Number(ivaC) + parseFloat(inicialC)).toFixed(2);


    return {
      inicial: inicialC,
      iva: ivaC,
      total: totalC
    }
  }

  function calcularCostos(fila){
    let servicioId = $(fila).find('td > input#servicio_id').val();
    let UUID = $(fila).find('td > input#servicio_uuid').data("uuid")
    let precioInicial = $(fila).find('td > input#precio_inicial').val();
    let numeroServicios = $(fila).find('td > input#number').val();
    let descuento = $(fila).find('td > input#descuento_aplicado').val();
    let _descuento = descuento;
    
    let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
    let precioBruto2 = precioBruto;
    let _ahorro = (precioBruto2 * descuento) / 100;
    precioBruto = (precioBruto2 - _ahorro).toFixed(2);

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
    $("#descripcion_servicio").val("");
    $("#tipo").val("");
    $("#precio").val("");
    $("#cantidad").val(1);
    $("#descuento").val(0);
    $("#img_servicio2").attr('src',``);
    $("#img_servicio2").addClass('image-cont')
  }

  function validarProductoServicio(){
    let servicio_id = $("#servicio_id").val();
    let nombre = $("#nombre_serv").val();
    let descripcion = $("#descripcion_servicio").val();
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