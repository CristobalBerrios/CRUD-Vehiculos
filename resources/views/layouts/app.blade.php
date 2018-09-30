<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vehiculos CRUD</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/vuetify.css') }}">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

  </head>
  <body>
    <div id="app">
      <v-app>
        <v-navigation-drawer
          v-model="drawer"
          clipped
          fixed
          app>
          <v-list dense>
            <v-list-tile @click="">
              <v-list-tile-action>
                <v-icon>people</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Usuarios</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="">
              <v-list-tile-action>
                <v-icon>directions_car</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Vehiculos</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-navigation-drawer>
        <v-toolbar app fixed clipped-left>
          <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
          <v-toolbar-title>Vehiculos CRUD</v-toolbar-title>
        </v-toolbar>
        <v-content>
          <v-container grid-list-md fluid>
            @yield('content')
          </v-container>
        </v-content>
      </v-app>
    </div>
        
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
