@extends('app')

@section('titulo', 'Registro de Ventas')

@section('main')
  <div class="bg-primary border border-primary rounded-top pl-2">
    <h1>Registro de Ventas</h1>
  </div>

  <section class="border border-primary rounded-bottom">
    <div class="text-right mr-4">
      <span class="font-weight-bold text-success">Folio de venta: {{ $venta->id }} 0001</span>
    </div>
    <div class="form-group row ml-3">
      <label for="cliente" class="col-md-1 col-form-label">Cliente:</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="cliente" placeholder="Buscar cliente...">
      </div>
    </div>
    <hr>
    <div class="form-group row ml-3">
      <label for="articulo" class="col-md-1 col-form-label">Artículo:</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="articulo" placeholder="Buscar artículo...">
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-secondary">Agregar</button>
      </div>
    </div>
  </section>

  <section>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Descripción Artículo</th>
          <th>Modelo</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Importe</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </section>
@endsection
