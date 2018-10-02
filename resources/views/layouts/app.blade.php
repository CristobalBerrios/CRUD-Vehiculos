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
    <style>
    </style>

  </head>
  <body>
    <div id="app" style="visibility: hidden;">
      <v-app>
        <v-navigation-drawer
          v-model="drawer"
          clipped
          fixed
          app>
          <v-list dense>
            <v-list-tile @click="go('/')">
              <v-list-tile-action>
                <v-icon>people</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Usuarios</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="go('/vehiculos')">
              <v-list-tile-action>
                <v-icon>directions_car</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>Vehiculos</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-navigation-drawer>
        <v-toolbar color="blue darken-4" dark app fixed clipped-left>
          <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
          <v-toolbar-title>Vehiculos CRUD</v-toolbar-title>
        </v-toolbar>
        <v-content>
          <v-container grid-list-md>
            @yield('content')
          </v-container>
        </v-content>
      </v-app>
    </div>
        
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
