<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="vehiculos"
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.nombre }}</td>
        <td class="text-xs-left">{{ props.item.apellidos }}</td>
        <td class="text-xs-left">{{ props.item.correo }}</td>
        <td class="text-xs-left"> 
          <v-btn @click="editarVehiculo(props.item)" icon>
            <v-icon color="blue">edit</v-icon>
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
          <v-btn color="green darken-1" flat @click.native="eliminarVehiculo()">Confirmar</v-btn>
          <v-btn color="green darken-1" flat @click.native="dialog = false">Cancelar</v-btn>
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
        { text: 'Marca', align: 'left', value: 'marca' },
        { text: 'Modelo',  align: 'left', value: 'modelo' },
        { text: 'Año',  align: 'left', value: 'year' },
        { text: 'Precio',  align: 'left', value: 'precio' },
        { text: 'Dueño',  align: 'left' }
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

