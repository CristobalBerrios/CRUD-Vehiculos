@extends('layouts.app')

@section('content')
<v-layout row wrap>
  <v-flex xs12>
    <h4 class="font-weight-thin display-1">Vehiculos</h4>
  </v-flex>
  <v-flex xs12>
    <vehiculos-component></vehiculos-component>
  </v-flex>
</v-layout>
@endsection