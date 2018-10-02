<template>
  <section>
    <v-data-table
      :headers="headers"
      :items="vehiculos"
      no-data-text="El usuario no tiene vehiculos"
      hide-actions
      class="elevation-1">
      <template slot="items" slot-scope="props">
        <td class="text-xs-left">{{ props.item.marca }}</td>
        <td class="text-xs-left">{{ props.item.modelo }}</td>
        <td class="text-xs-left">{{ props.item.year }}</td>
        <td class="text-xs-left">{{ props.item.precio }}</td>
      </template>
    </v-data-table>
  </section>
</template>

<script>
export default {
  data () {
    return {
      headers: [
        { text: 'Marca', align: 'left', sortable: false, value: 'marca' },
        { text: 'Modelo',  align: 'left', sortable: false, value: 'modelo' },
        { text: 'Año',  align: 'left', sortable: false, value: 'year' },
        { text: 'Precio',  align: 'left', sortable: false, value: 'precio' }
      ]
    }
  },
  props: ['vehiculos']
}
</script>


