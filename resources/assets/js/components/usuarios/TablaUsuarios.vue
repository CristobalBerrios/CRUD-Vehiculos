<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="usuarios"
      no-data-text=""
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.nombre }}</td>
        <td class="text-xs-left">{{ props.item.apellidos }}</td>
        <td class="text-xs-left">{{ props.item.correo }}</td>
        <td class="text-xs-left"> 
          <v-btn color="blue darken-4" dark small @click="showVehiculos(props.item)">
            Ver Vehiculos
          </v-btn>
        </td>
        <td class="text-xs-left"> 
          <v-btn @click="editarUsuario(props.item)" icon>
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
        <v-card-title class="headline">Eliminar Usuario</v-card-title>
        <v-card-text>Si elimina el usuario tambien se eliminaran sus vehiculos, ¿esta seguro ?</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat @click.native="eliminarUsuario()">Confirmar</v-btn>
          <v-btn flat @click.native="dialog = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogVehiculos" max-width="500">
      <v-card>
        <vehiculos-usuario :vehiculos="usuarioEdit.vehiculos"></vehiculos-usuario>
      </v-card>
    </v-dialog>
  </section>
</template>

<script>
import VehiculosUsuario from '../vehiculos/VehiculosUsuario'
export default {
  data () {
    return {
      headers: [
        { text: 'Nombre', align: 'left', sortable: false, value: 'nombre' },
        { text: 'Apellidos',  align: 'left', sortable: false, value: 'apellidos' },
        { text: 'Correo',  align: 'left', sortable: false, value: 'correo' },
        { text: '',  align: 'left', sortable: false },
        { text: '',  align: 'left', sortable: false }
      ],
      usuarios: [],
      usuarioEdit: {},
      index: 0,
      dialog: false,
      dialogVehiculos: false
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
    },
    showVehiculos (usuario) {
      this.usuarioEdit = usuario
      this.dialogVehiculos = true
    }
  },
  created () {
    this.$parent.$on('nuevoUsuario', this.nuevoUsuario)
    this.$parent.$on('actualizarUsuario', this.actualizarUsuario)

    axios.get('/api/usuarios').then(response => {
      this.usuarios = response.data
    })
  },
  components: {VehiculosUsuario}
}
</script>

