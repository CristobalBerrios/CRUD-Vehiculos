<template>
<section>
  <v-flex xs12 md8 lg8>
    <v-flex offset-md8 offset-lg8 xs12>
      <v-btn block dark>Agregar Usuario</v-btn>
    </v-flex>
    <tabla-usuarios></tabla-usuarios>
  </v-flex>
</section>
</template>

<script>
import TablaUsuarios from './TablaUsuarios'
export default {
  components: {TablaUsuarios}
}
</script>

