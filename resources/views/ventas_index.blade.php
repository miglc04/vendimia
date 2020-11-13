@extends('app')

@section('titulo', 'Ventas Registradas')

@section('main')
  <h1 class="d-inline">Ventas Activas</h1>
  <a href="{{ route('ventas.create') }}" class="btn btn-primary float-right">Nueva Venta</a>

  <section>
    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Folio Venta</th>
          <th>Clave Cliente</th>
          <th>Nombre</th>
          <th>Total</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($ventas as $venta)
          <tr>
            <td>$venta->id</td>
            <td>$venta->cliente->id</td>
            <td>$venta->cliente->nombreCompleto</td>
            <td>$venta->total</td>
            <td>$venta->fechaVenta</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
@endsection
