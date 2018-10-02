<template>
<section>
  <v-flex xs12 md10 lg10>
    <v-flex offset-md8 offset-lg8 xs12>
      <v-btn color="blue darken-4" block dark @click="showForm">Agregar Usuario</v-btn>
    </v-flex>
    <tabla-usuarios @editarUsuario="showForm"></tabla-usuarios>
  </v-flex>
  <form-usuario 
    :usuario="usuario"
    :dialog="dialog"
    @nuevoUsuario="nuevoUsuario"
    @actualizarUsuario="actualizarUsuario"
    @closeDialog="dialog = false">
  </form-usuario>
</section>
</template>

<script>
import TablaUsuarios from './TablaUsuarios'
import FormUsuario from './FormUsuario'
export default {
  data () {
    return {
      dialog: false,
      usuario: {}
    }
  },
  components: {TablaUsuarios, FormUsuario},
  methods: {
    showForm (usuario) {
      if (usuario) this.usuario = usuario
      else this.usuario = {}
      this.dialog = true
    },
    nuevoUsuario (usuario) {
      this.$emit('nuevoUsuario', usuario)
    },
    actualizarUsuario (usuario) {
      this.$emit('actualizarUsuario', usuario)
    }
  }
}
</script>

