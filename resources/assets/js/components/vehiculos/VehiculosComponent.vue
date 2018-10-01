<template>
<section>
  <v-flex xs12 md8 lg8>
    <v-flex offset-md8 offset-lg8 xs12>
      <v-btn block dark @click="showForm">Agregar Vehiculo</v-btn>
    </v-flex>
    <tabla-vehiculos @editarVehiculo="showForm"></tabla-vehiculos>
  </v-flex>
  <form-vehiculo
    :vehiculo="vehiculo"
    :dialog="dialog"
    @nuevoVehiculo="nuevoVehiculo"
    @actualizarVehiculo="actualizarVehiculo"
    @closeDialog="dialog = false">
  </form-vehiculo>
</section>
</template>

<script>
import TablaVehiculos from './TablaVehiculos'
import FormVehiculo from './FormVehiculo'
export default {
  data () {
    return {
      dialog: false,
      vehiculo: {}
    }
  },
  components: {TablaVehiculos, FormVehiculo},
  methods: {
    showForm (vehiculo) {
      if (vehiculo) this.vehiculo = vehiculo
      else this.vehiculo = {}
      this.dialog = true
    },
    nuevoVehiculo (vehiculo) {
      this.$emit('nuevoVehiculo', vehiculo)
    },
    actualizarVehiculo (vehiculo) {
      this.$emit('actualizarVehiculo', vehiculo)
    }
  }
}
</script>