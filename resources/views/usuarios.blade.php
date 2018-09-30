@extends('layouts.app')

@section('content')
<v-layout row wrap>
  <v-flex xs12>
    <h4 class="font-weight-thin display-1">Usuarios</h4>
  </v-flex>
  <v-flex xs12>
    <usuarios-component></usuarios-component>
  </v-flex>
</v-layout>
@endsection