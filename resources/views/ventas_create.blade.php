@extends('app')

@section('titulo', 'Registro de Ventas')

@section('main')
  <div class="bg-primary border border-primary rounded-top pl-2">
    <h1>Registro de Ventas</h1>
  </div>

  <section class="border border-primary rounded-bottom">
    <div class="text-right mr-4">
      <span class="font-weight-bold text-success">Folio de venta: {{ $venta->id }}</span>
    </div>
    <div class="form-group row ml-3">
      <label for="cliente" class="col-md-1 col-form-label">Cliente:</label>
      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Buscar cliente..."
          v-model="cliente.nombreCompleto"
          v-on:keyup="buscarCliente">
        <div v-if="cliente.id == 0" class="border">
          <option
            v-for="cliente of clientes"
            v-on:click="setCliente(cliente)">@{{ nombreCompleto(cliente) }}</option>
        </div>
      </div>
      <span v-if="cliente.id != 0">RFC: <b>@{{ cliente.rfc }}</b></span>
    </div>
    <hr>
    <div class="form-group row ml-3">
      <label for="articulo" class="col-md-1 col-form-label">Artículo:</label>
      <div class="col-md-3">
        <input type="text" class="form-control" id="articulo" placeholder="Buscar artículo..."
          v-model="articulo.descripcion"
          v-on:keyup="buscarArticulo">
        <div v-if="articulo.id == 0" class="border">
          <option v-for="articulo of articulos">@{{ articulo.descripcion }}</option>
        </div>
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

@section('scripts')
  <script type="text/javascript">
    const app = new Vue({
      el: ('#app'),
      data: {
        cliente: { id: 0, nombreCompleto: '', rfc: '' },
        articulo: { id: 0, descripcion: '' },
        clientes: [],
        articulos: []
      },
      watch: {
        'cliente.nombreCompleto': function (cadena) {
          if (cadena.trim().length < 3) {
            this.cliente.id = 0
            this.cliente.rfc = ''
            this.clientes = []
          }
        },
        'articulo.descripcion': function (cadena) {
          if (cadena.trim().length < 3) {
            this.articulo.id = 0
            this.articulos = []
          }
        }
      },
      methods: {
        buscarCliente: function () {
          var this_ = this;
          if (this.cliente.id == 0 && this.cliente.nombreCompleto.trim().length >= 3) {
            axios.get('/busqueda/clientes', { params: { cliente: this.cliente.nombreCompleto} })
            .then(function (response) {
              this_.clientes = response.data
            })
            .catch(function (error) {
              console.log(error)
            })
          }
        },
        nombreCompleto: function (cliente) {
          return `${cliente.nombre} ${cliente.apellido_paterno} ${cliente.apellido_materno}`
        },
        setCliente: function (cliente) {
          this.cliente.id = cliente.id
          this.cliente.nombreCompleto = this.nombreCompleto(cliente)
          this.cliente.rfc = cliente.rfc
        },
        buscarArticulo: function () {
          var this_ = this;
          if (this.articulo.descripcion.trim().length >= 3) {
            axios.get('/busqueda/articulos', { params: { articulo: this.articulo.descripcion} })
            .then(function (response) {
              this_.articulos = response.data
            })
            .catch(function (error) {
              console.log(error)
            })
          }
        }
      }
    });
  </script>
@endsection
