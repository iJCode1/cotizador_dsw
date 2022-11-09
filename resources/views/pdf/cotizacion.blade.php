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

  {{-- <div class="page-break"></div>
  <h1>Nombre: {{ $producto[0]->nombre }}</h1>
  <textarea>{{ $producto[0]->descripcion }}</textarea>
  <p>Código: {{ $producto[0]->codigo }}</p>
  <p>Precio: {{ $producto[0]->precio_bruto }}</p> --}}

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Código</th>
        <th>Precio</th>
        <th>Tipo</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($producto as $product)
        <tr>
          <td>{{ $product->producto_servicio_id }}</td>
          <td>{{ $product->nombre }}</td>
          <td>{{ $product->descripcion }}</td>
          <td>{{ $product->codigo }}</td>
          <td>{{ $product->precio_bruto }}</td>
          <td>{{ $product->tipo->nombre_tipo }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>