@extends('app')

@section('titulo', 'Articulos')

@section('main')
  {{-- Titulo --}}
  <h1>Articulos </h1>

  {{-- Articulo Nuevo --}}
  <section class="my-4">
    <div class="form-group row">
      <label for="descripcion" class="col-sm-3 col-form-label">Descripcion:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="descripcion" minlength="3"
          v-model="articuloNuevo.descripcion">
      </div>
    </div>
    <div class="form-group row">
      <label for="modelo" class="col-sm-3 col-form-label">Modelo:</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="modelo" minlength="3"
          v-model="articuloNuevo.modelo">
      </div>
    </div>
    <div class="form-group row">
      <label for="precio" class="col-sm-3 col-form-label">Precio:</label>
      <div class="col-sm-9">
        <input type="number" class="form-control" id="precio" step=".01"
          v-model="articuloNuevo.precio">
      </div>
    </div>
    <div class="form-group row">
      <label for="existencia" class="col-sm-3 col-form-label">Existencia:</label>
      <div class="col-sm-9">
        <input type="number" class="form-control" id="existencia"
          v-model="articuloNuevo.existencia">
      </div>
    </div>
    <button type="button" class="btn btn-secondary">Limpiar</button>
    <button class="btn btn-primary" v-on:click="crearArticulo">Guardar</button>
  </section>

  {{-- Listado de Articulos --}}
  <section class="my-4">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Descripcion</th>
          <th>Modelo</th>
          <th>Precio</th>
          <th>Existencia</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(articulo, index) of articulos">
          <td>@{{ articulo.descripcion }}</td>
          <td>@{{ articulo.modelo }}</td>
          <td>@{{ articulo.precio }}</td>
          <td>@{{ articulo.existencia }}</td>
          <td>
            <button type="button" class="btn btn-outline-info"
              data-toggle="modal" data-target="#verArticulo"
              v-on:click="obtenerArticulo(articulo.id)"><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-outline-danger"
              v-on:click="eliminarArticulo(articulo.id, index)"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </section>

  {{-- Modal Ver Articulo --}}
  <div class="modal fade" tabindex="-1" id="verArticulo">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detalle Artículo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="id" class="col-sm-3 col-form-label">Id:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="id" disabled
               v-model="articuloEdit.id">
            </div>
          </div>
          <div class="form-group row">
            <label for="descripcionDos" class="col-sm-3 col-form-label">Descripcion:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="descripcionDos" minlength="3"
               v-model="articuloEdit.descripcion">
            </div>
          </div>
          <div class="form-group row">
            <label for="modeloDos" class="col-sm-3 col-form-label">Modelo:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="modeloDos" minlength="3"
               v-model="articuloEdit.modelo">
            </div>
          </div>
          <div class="form-group row">
            <label for="precioDos" class="col-sm-3 col-form-label">Precio:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="precioDos" step=".01"
               v-model="articuloEdit.precio">
            </div>
          </div>
          <div class="form-group row">
            <label for="existenciaDos" class="col-sm-3 col-form-label">Existencia:</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="existenciaDos"
               v-model="articuloEdit.existencia">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" v-on:click="actualizarArticulo(articuloEdit.id)">Guardar</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript" src="{{ asset('assets/js/articulos.js') }}"></script>
@endsection
