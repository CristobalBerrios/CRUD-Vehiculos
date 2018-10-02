<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="vehiculos"
      no-data-text=""
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.marca }}</td>
        <td class="text-xs-left">{{ props.item.modelo }}</td>
        <td class="text-xs-left">{{ props.item.year }}</td>
        <td class="text-xs-left">{{ props.item.precio }}</td>
        <td class="text-xs-left">{{ props.item.usuario.nombre_completo }}</td>
        <td class="text-xs-left"> 
          <v-btn @click="editarVehiculo(props.item)" icon>
            <v-icon color="blue darken-4">edit</v-icon>
          </v-btn>
          <v-btn @click="index = props.index, dialog = true" icon>
            <v-icon color="red">delete</v-icon>
          </v-btn>
        </td>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" persistent max-width="290">
      <v-card>
        <v-card-title class="headline">Eliminar Vehiculo</v-card-title>
        <v-card-text>¿Esta seguro de eliminar el vehiculo ?</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat @click.native="eliminarVehiculo()">Confirmar</v-btn>
          <v-btn flat @click.native="dialog = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </section>
</template>

<script>
export default {
  data () {
    return {
      headers: [
        { text: 'Marca', align: 'left', sortable: false, value: 'marca' },
        { text: 'Modelo',  align: 'left', sortable: false, value: 'modelo' },
        { text: 'Año',  align: 'left', sortable: false, value: 'year' },
        { text: 'Precio',  align: 'left', sortable: false, value: 'precio' },
        { text: 'Dueño',  align: 'left', sortable: false, value: 'usuario.nombre' },
        { text: '',  align: 'left', sortable: false }
      ],
      vehiculos: [],
      vehiculoEdit: {},
      index: 0,
      dialog: false
    }
  },
  methods: {
    nuevoVehiculo (vehiculo) {
      this.vehiculos.push(vehiculo)
    },
    editarVehiculo (vehiculo) {
      this.$emit('editarVehiculo',JSON.parse(JSON.stringify(vehiculo)))
      this.vehiculoEdit = vehiculo
    },
    actualizarVehiculo (vehiculo) {
      this.vehiculoEdit.marca = vehiculo.marca
      this.vehiculoEdit.modelo = vehiculo.modelo
      this.vehiculoEdit.year = vehiculo.year
      this.vehiculoEdit.precio = vehiculo.precio
      this.vehiculoEdit.usuario_id = vehiculo.usuario_id
      this.vehiculoEdit.usuario = vehiculo.usuario
    },
    eliminarVehiculo () {
      let id = this.vehiculos[this.index].id
      axios.delete(`/api/vehiculos/${id}`).then(response => {
        this.dialog = false
        this.vehiculos.splice(this.index, 1)
      })
    }
  },
  created () {
    this.$parent.$on('nuevoVehiculo', this.nuevoVehiculo)
    this.$parent.$on('actualizarVehiculo', this.actualizarVehiculo)

    axios.get('/api/vehiculos').then(response => {
      this.vehiculos = response.data
    })
  }
}
</script>

