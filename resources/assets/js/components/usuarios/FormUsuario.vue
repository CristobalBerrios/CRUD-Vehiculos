<template>
  <v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
      <v-toolbar flat color="blue" dark>
        <v-toolbar-title v-if="usuario.nombre">Editar Usuario</v-toolbar-title>
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
            required>
          </v-text-field>
          <v-text-field
            v-model="usuario.apellidos"
            label="Apellidos"
            required>
          </v-text-field>
          <v-text-field
            v-model="usuario.correo"
            label="Correo"
            required>
          </v-text-field>

          <v-btn block :disabled="!valid" @click="editarUsuario(usuario)" v-if="usuario.nombre">Guardar</v-btn>
          <v-btn block :disabled="!valid" @click="agregarUsuario(usuario)" v-else>Agregar</v-btn>
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
      title: ''
    }
  },
  props: ['dialog', 'usuario'],
  methods: {
    closeDialog () {
      this.$emit('closeDialog')
    },
    editarUsuario (usuario) {
      axios.put(`/api/usuarios/${usuario.id}`, usuario).then(() => {
        this.$emit('actualizarUsuario', usuario)
        this.closeDialog()
      })
    },
    agregarUsuario (usuario) {
      axios.post('/api/usuarios', usuario).then(response => {
        this.$emit('nuevoUsuario', response.data)
        this.closeDialog()
      })
    }
  }
}
</script>

