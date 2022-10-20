@extends('layouts.app')

@section('content')
<div class="container">
  {{-- {{dd($cotizacion)}} --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Cotización') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.editCotizacion', $cotizacion) }}">
                        @csrf
                        @method('put')
                        {{-- Nombre del Producto y/o Servicio--}}
                        {{-- <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Producto y/o Servicio') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" autocomplete="nombre" autofocus placeholder="Página web informativa">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

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

                        {{-- Nombre de la Cotización --}}
                        <div class="form-group row">
                          <label for="nombre_cotizacion" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la cotización') }}</label>

                          <div class="col-md-6">
                            <input id="nombre_cotizacion" type="text" class="form-control @error('nombre_cotizacion') is-invalid @enderror" name="nombre_cotizacion" value="{{ old('nombre_cotizacion', $cotizacion->nombre_cotizacion) }}" autocomplete="nombre_cotizacion" autofocus>

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
                            <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion', $cotizacion->descripcion) }}" autocomplete="text" autofocus>

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
                              
                              <option selected disabled value="">Selecciona el status</option>
                              {{-- @if ($cotizacion->estatus_cotizacion_id)
                                @foreach($estatus as $estatu)
                                  @if ($cotizacion->estatus_cotizacion_id === $estatu->estatus_cotizacion_id)
                                    <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                    @continue
                                  @endif
                                  <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                @endforeach
                              @else    
                                @foreach($estatus as $estatu)
                                  @if (old('estatus_cotizacion_id') == $estatu->estatus_cotizacion_id)
                                    <option selected value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                    @continue
                                  @endif
                                <option value="{{$estatu->estatus_cotizacion_id}}">{{$estatu->estatus}}</option>
                                @endforeach
                              @endif --}}
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
                            </select>
                          </div>
                        </div>

                        {{-- <div class="alert alert-primary" role="alert">
                          <h5 class="text-center"><b>Desglose de costos</b> </h5>
                        </div> --}}
                        <div class="table-responsive">
                          <table class="table table-bordered border-dark" id="detalle-servicios">
                            <thead class="text-dark">
                              <tr>
                                <th>Servicio</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Precio bruto</th>
                                <th>Precio iva</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($servicios as $servicio)
                              <tr>
                                <td>{{$servicio->nombre}}</td>
                                <td>{{$servicio->descripcion}}</td>
                                <td>{{$servicio->cantidad}}</td>
                                <td>{{$servicio->precio_bruto}}</td>
                                <td>{{$servicio->iva}}</td>
                                <td>{{$servicio->subtotal}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="2" class="text-right">Total:</th>
                                <th>Total</th>
                                <th>Total</th>
                                <th>Total</th>
                                <th>Total</th>
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
                    {{-- {{dd(old('estatus_cotizacion_id'))}} --}}

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
  var total0 = 0;
  var total1 = 0;
  var total2 = 0;
  var total3 = 0;
  $('#detalle-servicios tbody').find('tr').each(function(i, el) {
      total0 += parseFloat($(this).find('td').eq(2).text());
      total1 += parseFloat($(this).find('td').eq(3).text());
      total2 += parseFloat($(this).find('td').eq(4).text());
      total3 += parseFloat($(this).find('td').eq(5).text());
  });
  $('#detalle-servicios tfoot tr th').eq(1).text("# " + total0);
  $('#detalle-servicios tfoot tr th').eq(2).text("$ " + total1);
  $('#detalle-servicios tfoot tr th').eq(3).text("$ " + total2);
  $('#detalle-servicios tfoot tr th').eq(4).text("$ " + total3);
});
</script>
@endsection
