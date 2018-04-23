@extends('layouts.app')

@section('content')
  <pagina tamanho="12">
<!--blades-template do laravel/com classes bootstrap-->
    @if($errors->all())
      <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $key => $value)
          <li><strong>{{$value}}</strong></li>
        @endforeach
      </div>
    @endif

    <painel titulo="Lista de Artigos">
      <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
      <!-- Large modal -->
      <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#meuModalTeste">Large modal</button> -->
      <!-- <modallink tipo="link" nome="meuModalTeste" titulo="Criar" css=""></modallink> --><!--foi passado para o tabela lista-->
      <!--{{$listaArtigos}}-->
      <tabela-lista
      v-bind:titulos="['#', 'Título','Descrição','Autor','data']"
      v-bind:itens="{{json_encode($listaArtigos)}}"
      ordem="desc" ordemCol="0"
      criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
      modal="sim"
      ></tabela-lista>
      <div align="center">
        {{$listaArtigos}}
      </div>


    </painel>
  </pagina>
  <!--vem da rota ->route('artigos.store') / token do laravel - > csrf_token()  -->
  <modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="POST" enctype="" token="{{ csrf_token() }}">
      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="{{old('titulo')}}">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricao" value="{{old('descricao')}}">
      </div>
        <!--implementar vue-ckeditor-->
        <div class="form-group">
          <label for="addConteudo">Conteúdo</label>

          <ckeditor
            id="addConteudo"
            name="conteudo"
            value="{{old('conteudo')}}"
            v-bind:config="{
                      toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                      ],
                      height: 200
                    }" >
          </ckeditor>

        </div>

      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAdicionar" class="btn btn-info">Adicionar</button>
    </span>

  </modal>
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
      <div class="form-group">
        <label for="titulo">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Titulo">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descricao">
      </div>

      <div class="form-group">
        <label for="editConteudo">Conteúdo</label>
        {{-- <textarea class="form-control" id="editConteudo" name="editConteudo" v-model="$store.state.item.conteudo"></textarea> --}}
        <ckeditor
          id="editConteudo"
          name="conteudo"
          v-model="$store.state.item.conteudo"
          v-bind:config="{
                    toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 200
                  }" >
        </ckeditor>
      </div>

      <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formEditar" class="btn btn-info">Atualizar</button>
    </span>
  </modal>
  <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
      {{-- //<!--quando usar {{}} o laravel reconhece como php, entao coloca @ para entender que é um javascript--> --}}
      <p>@{{$store.state.item.descricao}}</p>
      <p>@{{$store.state.item.conteudo}}</p>
  </modal>
@endsection
