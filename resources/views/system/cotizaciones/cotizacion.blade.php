@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Crear Cotizacion') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('tenant.cotizacion') }}">
            @csrf

            {{-- Nombre de la Cotización --}}
            <div class="form-group row">
              <label for="nombre_cot" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la cotización') }}</label>

              <div class="col-md-6">
                <input id="nombre_cot" type="text" class="form-control @error('nombre_cot') is-invalid @enderror" name="nombre_cot" value="{{ old('nombre_cot') }}" autocomplete="nombre_cot" autofocus>

                @error('nombre_cot')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Descripcion --}}
            <div class="form-group row">
              <label for="descripcion_cot" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

              <div class="col-md-6">
                <input id="descripcion_cot" type="text" class="form-control @error('descripcion_cot') is-invalid @enderror" name="descripcion_cot" value="{{ old('descripcion_cot') }}" autocomplete="text" autofocus>

                @error('descripcion_cot')
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
              <label for="estatus" class="col-md-4 col-form-label text-md-right">{{ __('Estatus de la cotización') }}</label>

              <div class="col-md-6">
                <select name="estatus" id="estatus" class="form-control estatus @error('estatus') is-invalid @enderror" autofocus>
                  
                  <option selected disabled value="">Selecciona el status</option>
                  @foreach($estatus as $estatu)
                    @if (old('estatus') == $estatu->estatus_cotizacion_id)
                      {{-- {{dd("Algo")}} --}}
                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                      @continue
                    @endif
                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                  @endforeach
                  
                  @error('estatus')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </select>
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
                <label for="descripcion" class="form-label">{{ __('Descripción') }}</label>
                <div class="form-group">
                    <input type="text" readonly class="form-control" id="descripcion" name="descripcion" value="{{old('descripcion')}}">
                    @error('descripcion')
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
  
  
              {{-- Cantidad --}}
              <div class="col-md-4">
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
                <table id="detalles" class="table table-striped table-bordered condensed table-hover">
                  <thead class="thead-dark">
                    <th>ID servicio</th>
                    <th>Nombre servicio</th>
                    <th>Precio inicial</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>Opciones</th>
                  </thead>
                  <tfoot>
                    <td colspan="4">Total</td>

                    <td>
                        <h4 id="total_inicial" name="total_inicial">$0.00</h4>
                    </td>
                    <td>
                        <h4 id="total_iva" name="total_iva">$0.00</h4>
                    </td>

                    <td>
                        <h4 id="total_total" name="total_total">$0.00</h4>
                    </td>
                  </tfoot>
                </table>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

function validarNumero(value) {
   var valor = $(value).val();
    if (!isNaN(valor) && valor >= 0){
      $(value).val(valor);
    }else{
      $(value).val(1);
    }
}

$(document).ready(function () {

  $('#servicio').autocomplete({
    source: function(request, response){
      // console.log(response);
      $.ajax({
        url: "{{route('tenant.buscarServicio')}}",
        type: "POST",
        data: {
          term: request.term,
          _token: $("input[name=_token]").val()
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
    const servicio = $('#servicio').val()
    // console.log(servicio);
    $.ajax({
      url: "{{route('tenant.seleccionarServicio')}}",
      type: "POST",
      data: {
        servicio: servicio,
        _token: $("input[name=_token]").val()
      },
      success: function(data) {
        // var jsvar = 'hola';
        // console.log(jsvar);
        let tiposPHP = '<?= json_encode($tipos) ?>'
        let tiposJson = JSON.parse(tiposPHP)
        let tipo_id = data.tipo_id

        let tipoDePS = tiposJson.filter((tipo) => {
          return tipo.tipo_id === tipo_id;
        })

        let tipoDelPS;

        tipoDelPS = (tipoDePS[0]) ? tipoDePS[0].nombre_tipo : "No definido";

        // console.log(tipoDelPS);

        // console.log( tiposJson ); 
        // console.log( valor ); 
        
        $("#servicio_id").val(data.producto_servicio_id ?? "Sin datos")
        $("#nombre_serv").val(data.nombre ?? "Sin datos")
        $("#descripcion").val(data.descripcion ?? "Sin datos")
        $("#tipo").val(tipoDelPS ?? "Sin datos")
        $("#precio").val(data.precio_bruto ?? "Sin datos")
      }
    });
  });

  $('#btn_add').click(function(){
    agregarProducto();
    console.log("Click");
  });

  let arrayServicios = [];

  function agregarProducto(){
    let nombre = $('#nombre_serv').val();
    let servicioId = $('#servicio_id').val();
    let precioInicial = $('#precio').val();
    let numeroServicios = $('#cantidad').val();
    let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
    let precioIva = (Number(precioBruto) * .16).toFixed(2);
    let subtotal = (Number(precioIva) + parseFloat(precioBruto)).toFixed(2);


    arrayServicios.push({
      servicioId,
      precioBruto: precioBruto,
      precioIva: precioIva,
      subtotal: subtotal,
    });

    // console.log(arrayServicios);

    const fila = `<tr id="fila"> 
      <td><input class="form-control" type="number" id="servicio_id" name="servicio_id[]" value="${servicioId}" readonly></td>
      <td><input class="form-control" type="text" id="nombre" name="nombre[]" value="${nombre}" readonly></td>
      <td><input class="form-control" type="number" id="precio_inicial" name="precio_inicial[]" value="${precioInicial}" readonly></td>
      <td><input class="form-control" type="number" id="numero_servicios" name="numero_servicios[]" value="${numeroServicios}" readonly></td>
      <td><input class="form-control" type="text" id="precio_bruto" name="precio_bruto[]" value="${precioBruto}" readonly></td>
      <td><input class="form-control" type="text" id="precio_iva" name="precio_iva[]" value="${precioIva}" readonly></td>
      <td><input class="form-control" type="number" id="subtotal" name="subtotal[]" value="${subtotal}" readonly></td> 
      <td><button type="button" class="btn btn-danger delete" value="Eliminar">X</button></td>
      </tr>; `

    $('#detalles').append(fila);

    let {
      inicial,
      iva,
      total
    } = sumarCostos(arrayServicios);
    
    $("#total_inicial").html("$" + inicial);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);

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

  $(document).on('click', '.delete', function(event) {
    // event.preventDefault();
    servicio_id = $(this).closest('tr')[0].getElementsByTagName('td')[0].getElementsByTagName('input')[0].value;
    
    arrayServicios = arrayServicios.filter((el => el.servicioId !== servicio_id));
    // console.log(arrayServicios);
    $(this).closest('tr').remove();

    let {
      inicial,
      iva,
      total
    } = sumarCostos(arrayServicios);
    
    $("#total_inicial").html("$" + inicial);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);
  });
});

</script>

@endsection