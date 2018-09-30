<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="clientes"
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.nombre }}</td>
        <td class="text-xs-left">{{ props.item.apellidos }}</td>
        <td class="text-xs-left">{{ props.item.correo }}</td>
        <td class="text-xs-left"> 
          <v-btn icon>
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
      clientes: []
    }
  },
  created () {
    axios.get('/api/usuarios').then(response => {
      this.clientes = response.data
    })
  }
}
</script>

