@extends('layouts.app')

@section('content')
  <pagina tamanho="10">
    <painel titulo="Dashboard">
      <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

      <div class="row">
        <div class="col-md-4">
          <caixa qtd="{{$totalArtigos}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion ion-pie-graph"></caixa>
        </div>
        <div class="col-md-4">
          <caixa qtd="{{$totalUsuarios}}" titulo="Usuários" url="{{route('usuarios.index')}}" cor="blue" icone="ion ion-person-stalker"></caixa>
        </div>
        <div class="col-md-4">
          <caixa qtd="{{$totalAutores}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="ion ion-person"></caixa>
        </div>
      </div>
    </painel>

  </pagina>
@endsection
{{-- <!--{{$totalArtigos}}{{$totalUsuarios}}{{$totalAutores}}--> --}}
