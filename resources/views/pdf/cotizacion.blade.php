<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Generar cotizaci&oacute;n</title>

    

    {{-- <link href="{{ asset('css/pdf.css') }}" rel="stylesheet" media="screen"> --}}
    <style type="text/css">
      * {
        font-family: Verdana, Arial, sans-serif;
      }
  
      table{
        font-size: x-small;
      }
  
      tfoot tr td{
        font-weight: bold;
        font-size: x-small;
        font-size: 12px;
      }
      
      tr td{
        font-size: 14px;
      }
  
      tr th{
        font-size: 12px;
      }
  
      .subtd{
        /* border: 1px solid lightgray; */
        width: max-content;
        padding: 8px;
        text-align: start;
      }

      .subtd > p,
      .subtd > h3{
        margin: 0;
      }
  
      .th-customer{
        color: white;
        padding: 8px;
        font-size: 16px;
      }
  
      .td-customer{
        /* font-size: 14px; */
      }
  
      .gray {
        background-color: lightgray;
      }
  
      .success {
        color: green;
      }
    </style>
</head>
<body>
  {{-- <header class="title">
    <h1>Cotización</h1>
  </header> --}}

  {{-- <h1>Nombre del cliente: {{ $request->nombreCliente }}</h1>
  <p>Folio de la cotización: {{ $request->folio_cotizacion }}</p>
  <textarea>{{ $request->descripcion }}</textarea> --}}

  {{-- <table class="table">
    <thead>
      <tr>
        <th>Servicio</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio Bruto</th>
        <th>Precio Iva</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($servicios as $servicio)
        <tr>
          <td>{{ $servicio->nombre }}</td>
          <td>{{ $servicio->descripcion }}</td>
          <td>{{ $servicio->cantidad }}</td>
          <td>{{ $servicio->precio_bruto }}</td>
          <td>{{ $servicio->iva }}</td>
          <td>{{ $servicio->subtotal }}</td>
        </tr>
      @endforeach
    </tbody>
  </table> --}}

  <!-- Cabecera -->
  <table width="100%">
    <tr>
      @if ($empresa->imagen !== null)
        <?php
          $nombreImagen = "images/productos_servicios/$empresa->imagen";
          $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
        ?>
        <td align="top">
          <img src="<?php echo $imagenBase64 ?>" width="120" />
        </td>
      @endif
      <td align="right">
        <td class="subtd" align="right">
          <h3>{{ $empresa->fqdn }}</h3>
          <p>Dirección: {{ $empresa->direccion }}</p>
          <p>C.P: {{ $empresa->codigo_postal }}</p>
          <p>Asesor de venta: {{ $cotizacion->user->nombre }}</p>
        </td>
        <td class="subtd" align="right">
          <h3 style="color: red">FOLIO: {{ $cotizacion->folio_cotizacion }}</h3>
          <p>FECHA: {{ $cotizacion->fecha_creacion }}</p>
          <p>CLIENTE ID: {{ $cotizacion->cliente_id }}</p>
          <p>VÁLIDO HASTA: {{ date("Y-m-d",strtotime($cotizacion->fecha_creacion."+ $cotizacion->vigencia days")) }}</p>
        </td>
      </td>
    </tr>
  </table>

  <!-- Información del cliente -->
  <table width="100%" style="margin-top: 16px;">
    <thead >
      <tr align="top" style="background-color: rgb(37, 157, 197);" width="100%">
        <th class="th-customer">Cliente</th>
      </tr>
      <tr align="left">
        <td class="td-customer">Nombre: {{ $cotizacion->cliente->nombre }}</td>
      </tr>
      <tr align="left">
        <td class="td-customer">Email: {{ $cotizacion->cliente->email }}</td>
      </tr>
      <tr align="left">
        <td class="td-customer">Dirección: {{ $cotizacion->cliente->direccion }}</td>
      </tr>
      <tr align="left">
        <td class="td-customer">Teléfono: {{ $cotizacion->cliente->telefono }}</td>
      </tr>
    </thead>
  </table>

  <br/>

  <!-- Resumen de la cotización -->
  <table width="100%">
    <thead style="background-color: rgb(37, 157, 197); color: white;">
      <tr>
        <th>Código</th>
        <th colspan="2">Descripción</th>
        <th>Cantidad</th>
        <th>Unidad</th>
        <th>Precio</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      {{-- foreach --}}
      {{-- dd($servicios[0]->unidad->nombre_unidad); --}}

      @foreach ($servicios as $servicio)
        <tr>
          <td scope="row">{{ $servicio->codigo }}</td>
          <td colspan="2">{!! $servicio->descripcion !!}</td>
          <td align="center">{{ $servicio->cantidad }}</td>
          @foreach ($unidades as $unidad)
            @if ($unidad->unidad_medida_id === $servicio->unidad_medida_id)
              <td align="center">{{ $unidad->nombre_unidad }}</td>
              @break
            @endif
          @endforeach
          {{-- <td align="center">${{ ($servicio->precio_inicial - (($servicio->precio_inicial * $servicio->descuento)/100) + ($servicio->precio_inicial - (($servicio->precio_inicial * $servicio->descuento)/100)) * 0.16 ) }}</td> --}}
          <td align="center">${{ round(($servicio->precio_inicial - (($servicio->precio_inicial * $servicio->descuento)/100)), 2) }}</td>
          <td align="right">${{ round((($servicio->precio_inicial - (($servicio->precio_inicial * $servicio->descuento)/100)) * $servicio->cantidad), 2) }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5"></td>
        <td align="right">Subtotal $</td>
        <td align="right" style="background-color: rgb(37, 157, 197); color: white;">{{ $subtotal }}</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Descuento</td>
        <td align="right" style="background-color: rgb(37, 157, 197); color: white;">{{ $servicio->descuento_general }}%</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Total impuestos $</td>
        <td align="right" style="background-color: rgb(37, 157, 197); color: white;">{{ $iva }}</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Total $</td>
        <td align="right" style="background-color: rgb(37, 157, 197); color: white;">{{ $total }}</td>
      </tr>
    </tfoot>
  </table>

{{-- <div class="first">
  <div class="pdf-image">
    <img src="<?php echo $imagenBase64 ?>" width="90" />
  </div>

  <div class="pdf-company">
    <div class="company-content1" >
      <p>Avenida Ignacio Manuel Altamirano 101 interior B Colonia La joya Zinacantepec,
        Toluca, Estado de México C.P. 51355
      </p>
      <p>Email: comercializadoracmeventas1@gmail.com</p>
      <p>Teléfono: 722 4027 100</p>
      <p>Asesor de venta: Ulises</p>
    </div>

    <div class="company-content2">
      <p>Fecha: 15/11/22</p>
      <p>Folio: COT-12</p>
      <p>Cliente ID: 1</p>
      <p>Valido hasta: 20/11/22</p>
    </div>
  </div>
</div> --}}

  {{-- <div>
    <img src="<?php echo $imagenBase64 ?>" width="90" />
  </div> --}}
        {{-- <br><br> --}}
        {{-- <div class="h2">
            <center><b><label>Cotizaci&oacute;n</label></b></center>
        </div> --}}
        {{-- <br> --}}
        {{-- <div class="h4">
            <table>
                <tr>
                    <td>Fecha de realizaci&oacute;n:</td><td><u>18/11/2022</u></td>
                </tr>
                <tr>
                    <td>Nombre del cliente: </td><td><u>Joel</u></td>
                </tr>
                <tr>
                    <td>Descripci&oacute;n del coche: </td><td><u>Buena descripcion</u></td>
                </tr>
            </table>
        </div> --}}

        {{-- <br> --}}

        {{-- <div class="table-responsive">
            <table class="table table-hover" border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th> No. </th>
                        <th>Refacci&oacute;n</th>
                        <th>Precio</th>
                        <th>No. de piezas</th>
                        <th>Mano de obra</th>
                        <th>Costo parcial</th>
                    </tr>
                </thead>
                <tbody>     
                  <tr>
                    <td>1</td>
                    <td>Nombreq</td>
                    <td>1200</td>
                    <td>2</td>
                    <td>100</td>
                    <td>1300</td>
                  </tr>
                </tbody>

            </table>
        </div> --}}
        {{-- <br><br> --}}
        {{-- <div class="h5">
            <p>
                La presente cotizaci&oacute;n no representa en forma alguna, reserva de inventario<br>
                Precios sujetos a cambios por el proveedor<br>
            </p>
        </div> --}}
        {{-- <br><br> --}}
        {{-- <div class="h5">
            <p><i>
                    Direcci&oacute;n: Calle 5 de febrero No.300 <br>
                    Teléfono: 22222222<br>
                    mecanico@gmail.com<br>
                </i></p>
        </div> --}}
</body>
</html>