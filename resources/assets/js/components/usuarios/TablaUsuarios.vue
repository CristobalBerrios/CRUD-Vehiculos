<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="usuarios"
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.nombre }}</td>
        <td class="text-xs-left">{{ props.item.apellidos }}</td>
        <td class="text-xs-left">{{ props.item.correo }}</td>
        <td class="text-xs-left"> 
          <v-btn @click="editarUsuario(props.item)" icon>
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
        <v-card-title class="headline">Eliminar Usuario</v-card-title>
        <v-card-text>¿Esta seguro de eliminar el usuario ?</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click.native="eliminarUsuario()">Confirmar</v-btn>
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
        { text: 'Nombre', align: 'left', value: 'nombre' },
        { text: 'Apellidos',  align: 'left', value: 'apellidos' },
        { text: 'Correo',  align: 'left', value: 'correo' },
        { text: '',  align: 'left' }
      ],
      usuarios: [],
      usuarioEdit: {},
      index: 0,
      dialog: false
    }
  },
  methods: {
    nuevoUsuario (usuario) {
      this.usuarios.push(usuario)
    },
    editarUsuario (usuario) {
      this.$emit('editarUsuario',JSON.parse(JSON.stringify(usuario)))
      this.usuarioEdit = usuario
    },
    actualizarUsuario (usuario) {
      this.usuarioEdit.nombre = usuario.nombre
      this.usuarioEdit.apellidos = usuario.apellidos
      this.usuarioEdit.correo = usuario.correo
    },
    eliminarUsuario () {
      let id = this.usuarios[this.index].id
      axios.delete(`/api/usuarios/${id}`).then(response => {
        this.dialog = false
        this.usuarios.splice(this.index, 1)
      })
    }
  },
  created () {
    this.$parent.$on('nuevoUsuario', this.nuevoUsuario)
    this.$parent.$on('actualizarUsuario', this.actualizarUsuario)

    axios.get('/api/usuarios').then(response => {
      this.usuarios = response.data
    })
  }
}
</script>

