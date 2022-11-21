<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Generar cotizaci&oacute;n</title>
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
    </style>
</head>
<body>

  <table width="100%">
    <tr>
      @if ($empresa->imagen !== "no-image.webp")
        <?php
          $nombreImagen = "images/logotipos/$empresa->imagen";
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
          <p>Asesor de venta: {{ ucfirst($cotizacion->user->nombre)." ".ucfirst($cotizacion->user->apellido_p)." ".ucfirst($cotizacion->user->apellido_m) }}</p>
        </td>
        <td class="subtd" align="right">
          <h3 style="color: #db2a24">FOLIO: {{ $cotizacion->folio_cotizacion }}</h3>
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
      <tr align="top" style="background-color: #0B6FED;" width="100%">
        <th class="th-customer">Cliente</th>
      </tr>
      <tr align="left">
        <td class="td-customer">Nombre: {{ ucfirst($cotizacion->cliente->nombre)." ".ucfirst($cotizacion->cliente->apellido_p)." ".ucfirst($cotizacion->cliente->apellido_m) }}</td>
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

  <table width="100%">
    <thead style="background-color: #0B6FED; color: white;">
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
        <td align="right" style="background-color: #0B6FED; color: white;">{{ $subtotal }}</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Descuento</td>
        <td align="right" style="background-color: #0B6FED; color: white;">{{ $servicio->descuento_general }}%</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Total impuestos $</td>
        <td align="right" style="background-color: #0B6FED; color: white;">{{ $iva }}</td>
      </tr>
      <tr>
        <td colspan="5"></td>
        <td align="right">Total $</td>
        <td align="right" style="background-color: #0B6FED; color: white;">{{ $total }}</td>
      </tr>
    </tfoot>
  </table>

  <table width="100%" style="margin-top: 20px">
    <thead >
      <tr align="top" style="background-color: #0B6FED;" width="100%">
        <th style="padding: 4px; color: white; font-size: 16px;">Descripción de la cotización</th>
      </tr>
      <tr align="left">
        <td>{!! $cotizacion->descripcion !!}</td>
      </tr>
    </thead>
  </table>
</body>
</html>