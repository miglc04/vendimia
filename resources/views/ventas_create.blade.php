@extends('app')

@section('titulo', 'Registro de Ventas')

@section('main')
  <div class="bg-primary border border-primary rounded-top pl-2">
    <h1>Registro de Ventas</h1>
  </div>

  {{-- Cliente y Articulos --}}
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
          <option style="cursor: pointer;"
            v-for="cliente of clientesBusqueda"
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
          <option style="cursor: pointer;"
            v-for="articulo of articulosBusqueda"
            v-on:click="setArticulo(articulo)">@{{ articulo.descripcion }}</option>
        </div>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-secondary" v-on:click="agregarArticuloCompra">Agregar</button>
      </div>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Descripción Artículo</th>
          <th>Modelo</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Importe</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="articulo of articulosVenta" class="bg-light">
          <td>@{{ articulo.descripcion }}</td>
          <td>@{{ articulo.modelo }}</td>
          <td><input type="number"
            v-model="articulo.cantidad"
            v-on:change="validarCantidadMinima(articulo)"
            v-on:change="validarExistenciaMaxima(articulo)"></td>
          <td>@{{ formatoNumero( articulo.precio ) }}</td>
          <td class="text-right">@{{ formatoNumero( importe(articulo) ) }}</td>
          <td><button type="button" v-on:click="eliminarArticuloVenta(articulo)"><i class="fa fa-times"></i></button></td>
        </tr>
        <template v-if="articulosVenta.length != 0">
          <tr class="text-right">
            <td colspan="3"></td>
            <td><b>Enganche:</b></td>
            <td>@{{ formatoNumero(enganche) }}</td>
            <td></td>
          </tr>
          <tr class="text-right">
            <td colspan="3"></td>
            <td><b>Bonificación Enganche:</b></td>
            <td>@{{ formatoNumero(bonificacionEnganche) }}</td>
            <td></td>
          </tr>
          <tr class="text-right">
            <td colspan="3"></td>
            <td><b>Total: </b></td>
            <td>@{{ formatoNumero(totalAdeudo) }}</td>
            <td></td>
          </tr>
        </template>
      </tbody>
    </table>
  </section>

  {{-- Abonos Mensuales --}}
  <section class="my-4" v-if="verAbonos">
    <table class="table">
      <thead>
        <tr>
          <th colspan="5" class="text-center text-primary bg-light">ABONOS MENSUALES</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="plazo of plazos">
          <td>@{{ plazo }} ABONOS DE</td>
          <td>$ @{{ formatoNumero(calcularImporteAbono(plazo)) }}</td>
          <td>TOTAL A PAGAR $ @{{ formatoNumero(calcularTotalAPagar(plazo)) }}</td>
          <td>SE AHORRA $ @{{ formatoNumero(calcularImporteAhorra(plazo)) }}</td>
          <td><input type="radio" v-bind:value="plazo" v-model="plazoSeleccionado"></td>
        </tr>
      </tbody>
    </table>
  </section>

  {{-- Botones --}}
  <section class="text-right my-4">
    <button class="btn btn-success">Cancelar</button>
    <button class="btn btn-success" v-on:click="validarDatosDeCompra" v-if="!verAbonos">Siguiente</button>
    <button class="btn btn-success" v-on:click="realizarVenta" v-if="verAbonos">Guardar</button>
  </section>


@endsection

@section('scripts')
  <script type="text/javascript">
    var tasa_financiamiento = {{ $configuracion->tasa_financiamiento }},
      porc_enganche = {{ $configuracion->porc_enganche }},
      plazo_maximo = {{ $configuracion->plazo_maximo }};

    const app = new Vue({
      el: ('#app'),
      data: {
        cliente: { id: 0, nombreCompleto: '', rfc: '' },
        articulo: { id: 0, descripcion: '', cantidad: 1, precio: 0, importe: 0 },
        clientesBusqueda: [],
        articulosBusqueda: [],
        articulosVenta: [],
        verAbonos: false,
        plazos: [3, 6, 9, 12],
        plazoSeleccionado: 0
      },
      watch: {
        'cliente.nombreCompleto': function (cadena) {
          if (cadena.trim().length < 3) {
            this.cliente.id = 0
            this.cliente.rfc = ''
            this.clientesBusqueda = []
          }
        },
        'articulo.descripcion': function (cadena) {
          if (cadena.trim().length < 3) {
            this.articulo.id = 0
            this.articulosBusqueda = []
          }
        }
      },
      methods: {
        buscarCliente: function () {
          var vm = this;
          if (this.cliente.id == 0 && this.cliente.nombreCompleto.trim().length >= 3) {
            axios.get('/busqueda/clientes', { params: { cliente: this.cliente.nombreCompleto} })
            .then(function (response) {
              vm.clientesBusqueda = response.data
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
          var vm = this;
          if (this.articulo.descripcion.trim().length >= 3) {
            axios.get('/busqueda/articulos', { params: { articulo: this.articulo.descripcion} })
            .then(function (response) {
              vm.articulosBusqueda = response.data
            })
            .catch(function (error) {
              console.log(error)
            })
          }
        },
        setArticulo: function (articulo) {
          var precio_ = parseInt(articulo.precio) * (1 + (tasa_financiamiento * plazo_maximo) /100)

          this.articulo = articulo
          this.articulo.precio = precio_
          this.articulo.cantidad = 1
        },
        validarCantidadMinima: function (articulo) {
          if (articulo.cantidad <= 0) {
            alert("Cantidad no permitida")
            articulo.cantidad = 1
          }
        },
        agregarArticuloCompra: function () {
          if (this.articulo.id == 0) {
            alert("Primero tienes que elegir un artículo")
            return
          }

          if (this.articulo.existencia == 0) {
            alert("El artículo seleccionado no cuenta con existencia, favor de verificar.")
            return
          }

          var articulo_ = Object.assign({}, this.articulo)
          this.articulosVenta.push(articulo_)
          this.articulo.descripcion = ''
        },
        validarExistenciaMaxima: function (articulo) {
          if (articulo.cantidad > articulo.existencia) {
            alert("El artículo no cuenta con existencia suficientes.")
            articulo.cantidad = articulo.existencia
          }
        },
        eliminarArticuloVenta: function (articulo) {
          var index = this.articulosVenta.indexOf(articulo)
          this.articulosVenta.splice(index, 1)
        },
        validarDatosDeCompra: function () {
          if (this.cliente.id === 0 || this.articulosVenta.length === 0) {
            return alert("Los datos ingresados no son correctos, favor de verificar")
          } else {
            this.verAbonos = true
          }
        },
        calcularTotalAPagar: function (plazo) {
          return this.precioContado * (1 + (tasa_financiamiento * plazo) / 100)
        },
        calcularImporteAbono: function (plazo) {
          return this.calcularTotalAPagar(plazo) / plazo
        },
        calcularImporteAhorra: function (plazo) {
          return this.totalAdeudo - this.calcularTotalAPagar(plazo)
        },
        realizarVenta: function () {
          if (this.plazoSeleccionado === 0) {
            return alert("Debe seleccionar un plazo para realizar el pago de su compra")
          }

          console.log(this.plazoSeleccionado);

          // var vm = this
          // axios.post('/ventas', {
          //   params:
          //     {
          //       cliente: vm.cliente,
          //       articulosVenta: vm.articulosVenta,
          //       total: vm.totalAdeudo
          //     }
          //   })
          // .then(function (response) {
          //   location.href = '/ventas'
          // })
          // .catch(function (error) {
          //   console.log(error)
          // })
        },
        formatoNumero: function (num) {
          return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
        },
        importe: function (articulo) {
          return articulo.cantidad * articulo.precio
        }
      },
      computed: {
        importeSubtotal: function () {
          var vm = this,
            importeSubtotal = 0

          this.articulosVenta.forEach(function (articulo) {
            importeSubtotal += vm.importe(articulo)
          })

          return importeSubtotal
        },
        enganche: function () {
          return this.importeSubtotal * (porc_enganche / 100)
        },
        bonificacionEnganche: function () {
          return this.enganche * ((tasa_financiamiento * plazo_maximo) / 100)
        },
        totalAdeudo: function () {
          return this.importeSubtotal - this.enganche - this.bonificacionEnganche
        },
        precioContado: function () {
          return this.totalAdeudo / (1 + ((tasa_financiamiento * plazo_maximo) / 100))
        }
      }
    });
  </script>
@endsection
