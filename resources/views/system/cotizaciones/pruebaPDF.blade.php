@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card p-4">
    <form action="{{ route('tenant.generarpdf') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col col-md-6">
          <div class="form-group">
            <label for="">Fecha inicial</label>
            <input type="date" class="form-control" name="txtFechaInicial">
          </div>
        </div>
  
        <div class="col col-md-6">
          <div class="form-group">
            <label for="">Fecha final</label>
            <input type="date" class="form-control" name="txtFechaFinal">
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-block btn-primary float-right mt-2">Generar PDF</button>
    </form>
  </div>
</div>

@endsection