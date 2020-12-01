
const app = new Vue({
    el: ('#app'),
    data: {
        articulos: [],
        articuloNuevo: {
            descripcion: '',
            modelo: '',
            precio: 0.00,
            existencia: 0
        },
        articuloEdit: {
            id: 0,
            descripcion: '',
            modelo: '',
            precio: 0.00,
            existencia: 0
        }
    },
    methods: {
        obtenerArticulos: function () {
            var vm = this
            axios.get('/api/articulos')
            .then(function (response) {
              vm.articulos = response.data
            })
            .catch(function (error) {
              console.log(error)
            })
        },
        crearArticulo:  function () {
            if (this.articuloNuevo.descripcion.trim() == '' || this.articuloNuevo.modelo.trim() == '' ||
                this.articuloNuevo.precio == 0 || this.articuloNuevo.existencia == 0 ) {

                alert('Completa todos los campos')
                return
            }

            var vm = this

            axios.post('/api/articulos', {
                descripcion: this.articuloNuevo.descripcion,
                modelo: this.articuloNuevo.modelo,
                precio: this.articuloNuevo.precio,
                existencia: this.articuloNuevo.existencia
            })
            .then(function (response) {
                if (response.data.respuesta) {
                    alert('Articulo guardado correctamente')
                    vm.articuloNuevo.descripcion = ''
                    vm.articuloNuevo.modelo = ''
                    vm.articuloNuevo.precio = 0
                    vm.articuloNuevo.existencia = 0
                    vm.obtenerArticulos()
                }
            })
            .catch(function (error) {
              console.log(error)
            })
        },
        obtenerArticulo:  function (id) {
            var vm = this
            axios.get('/api/articulos/' + id)
            .then(function (response) {
              vm.articuloEdit = response.data
            })
            .catch(function (error) {
              console.log(error)
            })
        },
        actualizarArticulo:  function (id) {
            var vm = this
            axios.put('/api/articulos/' + id, {
                descripcion: this.articuloEdit.descripcion,
                modelo: this.articuloEdit.modelo,
                precio: this.articuloEdit.precio,
                existencia: this.articuloEdit.existencia
            })
            .then(function (response) {
                if (response.data.respuesta) {
                    alert('Articulo guardado correctamente')
                    $('#verArticulo').modal('hide');
                    vm.articuloEdit.descripcion = ''
                    vm.articuloEdit.modelo = ''
                    vm.articuloEdit.precio = 0
                    vm.articuloEdit.existencia = 0
                    vm.obtenerArticulos()
                }
            })
            .catch(function (error) {
              console.log(error)
            })
        },
        eliminarArticulo:  function (id, index) {
            if (confirm('¿Seguro que quiere eliminar el registro?')) {
                var vm = this
                axios.delete('/api/articulos/' + id)
                .then(function (response) {
                    if (response.data.respuesta) {
                        alert('Articulo eliminado correctamente')
                        vm.articulos.splice(index, 1)
                    }
                })
                .catch(function (error) {
                  console.log(error)
                })
            }
        }
    },
    // watch: { },
    // computed: { },
    mounted: function () {
        var vm = this
        this.$nextTick(function () {
            vm.obtenerArticulos()
        })
    }
});
