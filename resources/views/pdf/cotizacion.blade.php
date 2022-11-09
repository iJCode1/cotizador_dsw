<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cotización</title>
  <style>
    .page-break {
      page-break-after: always;
    }

    .title{
      border: 2px solid purple;
      border-radius: 15px;
      text-align: center
    }

    .table{
      width: 100%;
      border: 1px solid purple;
      text-align: center
    }
  </style>
</head>
<body>
  <header class="title">
    <h1>Cotización</h1>
  </header>

  <h1>Nombre del cliente: {{ $request->nombreCliente }}</h1>
  <p>Folio de la cotización: {{ $request->folio_cotizacion }}</p>
  <textarea>{{ $request->descripcion }}</textarea>

  <table class="table">
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
  </table>
</body>
</html>