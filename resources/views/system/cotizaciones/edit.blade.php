@extends('layouts.app')

@section('content')
<div class="container">
  {{-- {{dd($cotizacion)}} --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editar Cotización') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.editCotizacion', $cotizacion) }}">
                        @csrf
                        @method('put')

                        {{-- Datos del Cliente --}}

                        {{-- ID --}}
                        <div class="col-md-4 my-3" style="display: none;">
                          <label for="cliente_id" class="form-label">ID Cliente</label>
                          <div class="form-group">
                            <input type="text" readonly class="form-control" id="cliente_id" name="cliente_id" value="{{old('cliente_id', $cotizacion->cliente_id)}}">
                          </div>
                        </div>

                        {{-- Nombre --}}
                        <div class="my-3 text-center">
                          <p class="font-weight-bold">Nombre Cliente:
                            <span class="font-weight-normal">{{$cotizacion->cliente->nombre}}</span>
                          </p>
                        </div>

                        {{-- Correo --}}
                        <div class="my-3 text-center">
                          <p class="font-weight-bold">Correo Cliente:
                            <span class="font-weight-normal">{{$cotizacion->cliente->email}}</span>
                          </p>
                        </div>

                        {{-- Folio de la Cotización --}}
                        <div class="form-group row">
                          <label for="folio_cotizacion" class="col-md-4 col-form-label text-md-right">{{ __('Folio de la cotización') }}</label>

                          <div class="col-md-6">
                            <input id="folio_cotizacion" type="text" class="form-control @error('folio_cotizacion') is-invalid @enderror" name="folio_cotizacion" value="{{ old('folio_cotizacion', $cotizacion->folio_cotizacion) }}" autocomplete="folio_cotizacion" autofocus readonly>

                            @error('folio_cotizacion')
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
                            <textarea @if($usuario === "cliente") readonly @endif class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" name="descripcion_cotizacion" rows="2" autofocus autocomplete="text">{{ old('descripcion', $cotizacion->descripcion) }}</textarea>

                            @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>

                        {{-- Fecha de creación --}}
                        <div class="my-3 text-center">
                          <p class="font-weight-bold">Fecha de creación:
                            <span class="font-weight-normal">{{$cotizacion->fecha_creacion}}</span>
                          </p>
                        </div>

                        {{-- Vigencia --}}
                        <div class="my-3 text-center">
                          <p class="font-weight-bold">Vigencia (Días):
                            <span class="font-weight-normal">{{$cotizacion->vigencia}}</span>
                          </p>
                        </div>

                        {{-- Estatus de Cotización --}}
                        <div class="form-group row">
                          <label for="estatus_cotizacion_id" class="col-md-4 col-form-label text-md-right">{{ __('Estatus de la cotización') }}</label>
                          <div class="col-md-6">
                            <select name="estatus_cotizacion_id" id="estatus_cotizacion_id" class="form-control estatus_cotizacion_id @error('estatus_cotizacion_id') is-invalid @enderror" autofocus>
                              @if($usuario === "cliente")
                                <option selected value="{{$cotizacion->estatus_cotizacion_id}}">{{$cotizacion->estatus_cotizacion->estatus}}</option>
                              @else
                                <option selected disabled value="">Selecciona el status</option>
                                @foreach($estatus as $estatu)
                                  @if (old('estatus_cotizacion_id'))
                                    @if (old('estatus_cotizacion_id') == $estatu->estatus_cotizacion_id)
                                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                      @continue
                                      @endif
                                  @else
                                    @if ($cotizacion->estatus_cotizacion_id === $estatu->estatus_cotizacion_id)
                                      <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                      @continue
                                    @endif
                                  @endif
                                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                @endforeach
                                
                                @error('estatus_cotizacion_id')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              @endif
                            </select>
                          </div>
                        </div>
                        
                        <div class="table-responsive">
                          <table class="table table-bordered border-dark" id="detalle-servicios">
                            <thead class="text-dark">
                              <tr>
                                <th style="display: none">id</th>
                                <th>Servicio</th>
                                <th>Descripcion</th>
                                <th>Precio inicial</th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Precio bruto</th>
                                <th>Iva</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody id="t-body">
                              @foreach($servicios as $servicio)
                              <tr id="fila">
                                <td style="display: none" id="servicio_id">
                                  <input class="form-control servicio_id" type="text" name="servicio_id[]" value="{{$servicio->detalle_cotizacion_id}}">
                                </td>
                                <td id="nombre_serv">{{$servicio->nombre}}</td>
                                <td id="desc_serv">{{$servicio->descripcion}}</td>
                                <td>
                                  @if($usuario === "cliente")
                                    <span id="precio_inicialS">{{$servicio->precio_inicial}}</span>
                                    <input id="precio_inicial" style="display: none" name="precio_inicial[]" class="form-control precio_inicial @error('precio_inicial') is-invalid @enderror" type="number" value="{{ old('precio_inicial', $servicio->precio_inicial) }}" min="1" step="any" onkeyup="validarPrecio(this)"/>
                                  @else
                                    <input id="precio_inicial" name="precio_inicial[]" class="form-control precio_inicial @error('precio_inicial') is-invalid @enderror" type="number" value="{{ old('precio_inicial', $servicio->precio_inicial) }}" min="1" step="any" onkeyup="validarPrecio(this)"/>
                                    @error('precio_inicial')
                                      <small class="text-danger">{{$message}}</small>
                                    @enderror
                                  @endif
                                </td>
                                <td>
                                  <input id="cantidad" name="cantidad[]" class="form-control cantidad @error('cantidad') is-invalid @enderror" type="number" value="{{ old('cantidad', $servicio->cantidad) }}" min="1" step="1" onkeyup="validarCantidad(this)" />
                                  @error('cantidad')
                                    <small class="text-danger">{{$message}}</small>
                                  @enderror
                                </td>
                                <td>
                                  @if($usuario === "cliente")
                                    <span id="descuentosS">{{$servicio->descuento}}</span>
                                    <input style="display: none" id="descuento" name="descuento[]" class="form-control descuento @error('descuento') is-invalid @enderror" type="number" value="{{ old('descuento', $servicio->descuento) }}" min="0" max="100" step="any" onkeyup="validarDescuento(this)"/>
                                  @else
                                    <input id="descuento" name="descuento[]" class="form-control descuento @error('descuento') is-invalid @enderror" type="number" value="{{ old('descuento', $servicio->descuento) }}" min="0" max="100" step="any" onkeyup="validarDescuento(this)"/>
                                    @error('descuento')
                                      <small class="text-danger">{{$message}}</small>
                                    @enderror
                                  @endif
                                </td>
                                <td name="precio_bruto[]" class="precio_bruto">
                                  <span id="precio_brutoS">{{$servicio->precio_bruto}}</span>
                                  <input id="precio_bruto" style="display: none" type="text" name="precio_bruto[]" value="{{$servicio->precio_bruto}}">
                                </td>
                                <td>
                                  <span id="precio_ivaS">{{$servicio->iva}}</span>
                                  <input id="precio_iva" style="display: none" type="text" name="precio_iva[]" value="{{$servicio->iva}}">
                                </td>
                                <td>
                                  <span id="subtotalS">{{$servicio->subtotal}}</span>
                                  <input id="subtotal" style="display: none" type="text" name="subtotal[]" value="{{$servicio->subtotal}}">
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="8">
                                  @if($usuario === "cliente")
                                    <label for="descuento_general" class="form-label mr-1">{{ __('Descuento general (porcentaje):') }}</label>
                                    <span id="descuento_generalS">{{$servicio->descuento_general}}</span>
                                    <input style="display: none" type="number" class="form-control descuento_general @error('descuento_general') is-invalid @enderror" id="descuento_general" name="descuento_general" value="{{ old('descuento_general', $servicio->descuento_general) }}" min="0" max="100" step="any" onkeyup="validarDescuento(this)"/>
                                  @else
                                    <div class="form-group d-flex mb-0">
                                      <label for="descuento_general" class="form-label">{{ __('Descuento general (porcentaje)') }}</label>
                                      <input type="number" class="form-control descuento_general @error('descuento_general') is-invalid @enderror" id="descuento_general" name="descuento_general" value="{{ old('descuento_general', $servicio->descuento_general) }}" min="0" max="100" step="any" onkeyup="validarDescuento(this)"/>
                                      
                                      @error('descuento_general')
                                      <small class="text-danger">{{$message}}</small>
                                      @enderror
                                    </div>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th colspan="2" class="text-right">Total:</th>
                                <th id="total_inicial">Total</th>
                                <th id="total_cantidad" colspan="2">Total</th>
                                <th id="total_bruto">Total</th>
                                <th id="total_iva">Total</th>
                                <th id="total_total">Total</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>

                        {{-- Boton de Editar --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
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
<script>
function validarNumero(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 1){
    $(value).val(valor);
  }else{
    $(value).val(0);
  }
}

function validarPrecio(value) {
  let valor = $(value).val();
  if (isNaN(valor) || valor <= 0){
    $(value).val("");
  }
}

function validarCantidad(value) {
  let valor = $(value).val();
  if (!isNaN(valor) && valor >= 1){
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

$(document).ready(function() {

let arrayServicios = [];

/**
 * Agrega al arreglo cada uno de los productos/servicios 
 * de la cotización
*/
$('#detalle-servicios tbody').find('tr#fila').each(function(i, el) {
  arrayServicios.push({
    servicio_id: $(el).find('td#servicio_id > input.servicio_id').val(),
    cantidad: $(el).find('td > input#cantidad').val(),
    descuento: $(el).find('td > input#descuento').val(),
    descuento_general: $('input#descuento_general').val(),
    precio_inicial: $(el).find('td > input#precio_inicial').val(),
    precio_bruto: $(el).find('td > span#precio_brutoS').text(),
    precio_iva: $(el).find('td > span#precio_ivaS').text(),
    subtotal: $(el).find('td > span#subtotalS').text(),
  })
});

$(".cantidad").on("keyup keydown change", function(){
  let fila = $(this).closest("#fila");
  calcularCostos(fila);
});

$(".descuento").on("keyup keydown change", function(){
  let fila = $(this).closest("#fila");
  calcularCostos(fila);
});

$(".precio_inicial").on("keyup keydown change", function(){
  let fila = $(this).closest("#fila");
  calcularCostos(fila);
});

$(".descuento_general").on("keyup keydown change", function(){
  mostrarCostosFinal(arrayServicios);
});

mostrarCostosFinal(arrayServicios);

function mostrarCostosFinal(array){
  if (array.length > 0) {
    let {
      inicial,
      cantidad,
      bruto,
      iva,
      total
    } = sumarCostosArray(array);

    let descuento_general = $('input#descuento_general').val()
  
    if(descuento_general > 0){
      
      let _inicial = inicial;
      let _ahorro = (_inicial * descuento_general) / 100;
      inicial = (_inicial - _ahorro).toFixed(2);

      let _bruto = bruto;
      let _ahorro2 = (_bruto * descuento_general) / 100;
      bruto = (_bruto - _ahorro2).toFixed(2);

      iva = (Number(bruto) * .16).toFixed(2);
      total = (Number(iva) + parseFloat(bruto)).toFixed(2);
    }

    $("#total_inicial").html("$" + inicial);
    $("#total_cantidad").html("#" + cantidad);
    $("#total_bruto").html("$" + bruto);
    $("#total_iva").html("$" + iva);
    $("#total_total").html("$" + total);

  }
}

function sumarCostosArray(array){
  let inicial = 0;
  let cantidad = 0;
  let bruto = 0;
  let iva = 0;
  let total = 0;

  array.forEach((el) => {
    inicial += Number(el.precio_inicial),
    cantidad += Number(el.cantidad),
    bruto += Number(el.precio_bruto),
    iva += Number(el.precio_iva),
    total += Number(el.subtotal)
  })

  return {
    inicial: inicial.toFixed(2),
    cantidad,
    bruto: bruto.toFixed(2),
    iva: iva.toFixed(2),
    total: total.toFixed(2)
  }
}

function calcularCostos(fila){
  let servicioId = $(fila).find('td#servicio_id > input.servicio_id').val();
  let precioInicial = $(fila).find('td > input#precio_inicial').val();
  let precioBrutoDB = $(fila).find('td > span#precio_brutoS').text();
  let numeroServicios = $(fila).find('td > input#cantidad').val();
  let descuentoGeneral = $('input#descuento_general').val();
  let descuento = $(fila).find('td > input#descuento').val();
  let _descuento = descuento;

  let precioBruto = (Number(precioInicial) * Number(numeroServicios)).toFixed(2);
  let precioBruto2 = precioBruto;
  let _ahorro = (precioBruto2 * descuento) / 100;
  precioBruto = (precioBruto2 - _ahorro).toFixed(2);
  
  let precioIva = (Number(precioBruto) * .16).toFixed(2);
  let subtotal = (Number(precioIva) + parseFloat(precioBruto)).toFixed(2);
  
  $(fila).find('td > span#precio_brutoS').text(precioBruto);
  $(fila).find('td > input#precio_bruto').val(precioBruto);
  $(fila).find('td > span#precio_ivaS').text(precioIva);
  $(fila).find('td > input#precio_iva').val(precioIva);
  $(fila).find('td > span#subtotalS').text(subtotal);
  $(fila).find('td > input#subtotal').val(subtotal);

  añadirArray(servicioId, numeroServicios, descuento, descuentoGeneral, precioInicial, precioBruto, precioIva, subtotal)
}

function añadirArray(servicioId, numeroServicios, descuento, descuentoGeneral, precioInicial, precioBruto, precioIva, subtotal){
  arrayServicios = arrayServicios.filter((el => el.servicio_id !== servicioId));

  arrayServicios.push({
    servicio_id: servicioId,
    cantidad: numeroServicios,
    descuento: descuento,
    descuento_general: descuentoGeneral,
    precio_inicial: precioInicial,
    precio_bruto: precioBruto,
    precio_iva: precioIva,
    subtotal: subtotal,
  });

  mostrarCostosFinal(arrayServicios);
}

});
</script>
@endsection
