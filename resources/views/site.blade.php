@extends('layouts.app')

@section('content')
  <pagina tamanho="10">
    <painel titulo="Artigos">

      <p>
        <form class="form-inline text-center" action="{{route('site')}}" method="get">
          <input type="search" class="form-control" name="busca" placeholder="Buscar" value="{{isset($busca) ? $busca : ""}}">
          <button class="btn btn-info">Buscar</button>
        </form>

      </p>

      <div class="row">
        @foreach ($lista as $key => $value)
          <artigocard
          titulo="{{str_limit($value->titulo,25,"...")}}"
          descricao="{{str_limit($value->descricao,30,"...")}}"
          link="{{route('artigo',[$value->id,str_slug($value->titulo)])}}"
          imagem="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg"
          data="{{$value->data}}"
          autor="{{$value->autor}}"
          sm="6"
          md="4">
          </artigocard>
        @endforeach
        {{-- <artigocard
        titulo="Titulo teste"
        descricao="Laravel e vue js"
        link="#"
        imagem="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg"
        data="22/04/2018"
        autor="Renato"
        sm="6"
        md="4"

        >
        </artigocard> --}}

      </div>
      <div align="center">
        {{$lista}}
      </div>

    </painel>

  </pagina>
@endsection
