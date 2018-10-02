<template>
  <v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
      <v-toolbar color="blue darken-4" flat dark>
        <v-toolbar-title v-if="usuario.id">Editar Usuario</v-toolbar-title>
        <v-toolbar-title v-else>Agregar Usuario</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click="closeDialog()">
          <v-icon>close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="usuario.nombre"
            label="Nombre"
            :rules="formRules"
            required>
          </v-text-field>
          <v-text-field
            v-model="usuario.apellidos"
            label="Apellidos"
            :rules="formRules"
            required>
          </v-text-field>
          <v-text-field
            v-model="usuario.correo"
            label="Correo"
            :rules="correoRules"
            required>
          </v-text-field>

          <v-btn color="blue darken-4" dark block @click="editarUsuario(usuario)" v-if="usuario.id">Guardar</v-btn>
          <v-btn color="blue darken-4" dark block @click="agregarUsuario(usuario)" v-else>Agregar</v-btn>
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
      correoRules: [
        v => !!v || 'El campo es requerido',
        v => /.+@.+/.test(v) || 'Correo no valido'
      ]
    }
  },
  props: ['dialog', 'usuario'],
  methods: {
    closeDialog () {
      this.$emit('closeDialog')
      this.$refs.form.reset()
    },
    editarUsuario (usuario) {
      if (this.$refs.form.validate()) {
        axios.put(`/api/usuarios/${usuario.id}`, usuario).then(() => {
          this.$emit('actualizarUsuario', usuario)
          this.closeDialog()
        })
      }
    },
    agregarUsuario (usuario) {
      if (this.$refs.form.validate()) {
        axios.post('/api/usuarios', usuario).then(response => {
          let newUsuario = response.data
          newUsuario.vehiculos = usuario.vehiculos
          this.$emit('nuevoUsuario', newUsuario)
          this.closeDialog()
        })
      }
    }
  }
}
</script>

