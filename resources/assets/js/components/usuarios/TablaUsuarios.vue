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
          <v-btn icon>
            <v-icon color="red">delete</v-icon>
          </v-btn>
        </td>
      </template>
    </v-data-table>
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
      usuarioEdit: {}
    }
  },
  methods: {
    editarUsuario (usuario) {
      this.$emit('editarUsuario',JSON.parse(JSON.stringify(usuario)))
      this.usuarioEdit = usuario
    },
    actualizarUsuario (usuario) {
      this.usuarioEdit.nombre = usuario.nombre
      this.usuarioEdit.apellidos = usuario.apellidos
      this.usuarioEdit.correo = usuario.correo
    }
  },
  created () {
    this.$parent.$on('actualizarUsuario', this.actualizarUsuario)

    axios.get('/api/usuarios').then(response => {
      this.usuarios = response.data
    })
  }
}
</script>

