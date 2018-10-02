<template>
  <v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
      <v-toolbar color="blue darken-4" flat dark>
        <v-toolbar-title v-if="vehiculo.id">Editar Vehiculo</v-toolbar-title>
        <v-toolbar-title v-else>Agregar Vehiculo</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click="closeDialog()">
          <v-icon>close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="vehiculo.marca"
            label="Marca"
            :rules="formRules"
            required>
          </v-text-field>
          <v-text-field
            v-model="vehiculo.modelo"
            label="Modelo"
            :rules="formRules"
            required>
          </v-text-field>
          <v-text-field
            v-model.Number="vehiculo.year"
            type="number"
            label="Año"
            :rules="formRules"
            required>
          </v-text-field>
          <v-text-field
            v-model.Number="vehiculo.precio"
            type="number"
            label="Precio"
            :rules="formRules"
            required>
          </v-text-field>
          <v-select
            label="Dueño"
            :items="usuarios"
            item-text="nombre_completo"
            item-value="id"
            v-model="vehiculo.usuario"
            :rules="formRules"
            return-object
            required>
          </v-select>

          <v-btn color="blue darken-4" dark block @click="editarVehiculo(vehiculo)" v-if="vehiculo.id">Guardar</v-btn>
          <v-btn color="blue darken-4" dark block @click="agregarVehiculo(vehiculo)" v-else>Agregar</v-btn>
      </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
  
</template>

<script>
export default {
  data () {
    return {
      valid: true,
      title: '',
      formRules: [v => !!v || 'El campo es requerido'],
      usuarios: []
    }
  },
  props: ['dialog', 'vehiculo'],
  methods: {
    closeDialog () {
      this.$emit('closeDialog')
      this.$refs.form.reset()
    },
    editarVehiculo (vehiculo) {
      if (this.$refs.form.validate()) {
        vehiculo.usuario_id = vehiculo.usuario.id
        axios.put(`/api/vehiculos/${vehiculo.id}`, vehiculo).then(response => {
          this.$emit('actualizarVehiculo', vehiculo)
          this.closeDialog()
        })
      }
    },
    agregarVehiculo (vehiculo) {
      if (this.$refs.form.validate()) {
        vehiculo.usuario_id = vehiculo.usuario.id
        axios.post('/api/vehiculos', vehiculo).then(response => {
          let newVehiculo = response.data
          newVehiculo.usuario = vehiculo.usuario
          this.$emit('nuevoVehiculo', newVehiculo)
          this.closeDialog()
        })
      }
    }
  },
  created () {
    axios.get('/api/usuarios').then(response => {
      this.usuarios = response.data
    })
  }
}
</script>

