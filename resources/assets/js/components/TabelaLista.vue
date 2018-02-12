<template>
  <div class="">
    <div class="form-inline">
      <!--<p>{{this.$store.state.itens}}</p> usei para testar o vuex-->
      <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
        <modallink v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modallink>
      <div class="form-group pull-right">
        <input type="search" class="form-control" placeholder="Buscar" v-model="buscar" >
      </div>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos">{{titulo}}</th>

          <th v-if="detalhe || editar || deletar">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item,index) in lista">
          <td v-for="i in item">{{i}}</td> <!--//criou uma variavel i para receber item-->

          <td v-if="detalhe || editar || deletar">
            <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">

              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe |" css=""></modallink>


              <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
              <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo=" Editar |" css=""></modallink>

              <a href="#" v-on:click="executaForm(index)"> Deletar</a>
            </form>
            <span v-if="!token">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe |" css=""></modallink>

              <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
              <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo="Editar |" css=""></modallink>
              <a v-if="deletar" v-bind:href="deletar"> Deletar</a>
            </span>
            <span v-if="token && !deletar">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
              <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe |" css=""></modallink>

              <a v-if="editar && !modal" v-bind:href="editar"> Editar</a>
              <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo=" Editar" css=""></modallink>
            </span>



          </td>
        </tr>

      </tbody>
    </table>

  </div>

</template>

<script>
    export default {
      props:['titulos','itens', 'ordem', 'ordemCol', 'criar', 'detalhe', 'editar', 'deletar', 'token','modal'],
      data: function() {
        return{
          buscar:'',
          ordemAux: this.ordem || "asc",
          ordemAuxCol: this.ordemCol || 0
        }
      },
      methods:{
        executaForm: function(index){
          document.getElementById(index).submit();
        },
        ordenaColuna: function(coluna){
          this.ordemAuxCol = coluna;
          if(this.ordemAux.toLowerCase() == "asc"){
            this.ordemAux = 'desc';
          }else{
            this.ordemAux = 'asc';
          }
        }
      },
      computed:{
        lista:function(){

          //this.$store.commit('setItens',{Vuex:"OK"});//commit possibilita qual que vc quer executar

          //let busca = "php";
          // sort ordenaçao por javascript - funçao serve para alterar ordenaçao padrao.
          // this.itens.sort(function(a,b){
          //   if (a[0] > b[0]) {return 1;}
          //   if (a[0] < b[0]) {return -1;}
          //   return 0;
          // });
          let lista = this.itens.data;
          let ordem = this.ordemAux;
          let ordemCol = this.ordemAuxCol;
          ordem = ordem.toLowerCase();//mudar para letra minuscula
          ordemCol = parseInt(ordemCol);//garantir numero inteiro
          //verificar se o valor esta em ordem crescente.
          if(ordem == "asc"){
            lista.sort(function(a,b){
              if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return 1;}
              if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return -1;}
               return 0;
             });
          }else{
            lista.sort(function(a,b){
              if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return 1;}
              if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return -1;}
               return 0;
             });
          }

          // return this.itens.filter(res => {
          //   for(let k = 0; k < res.length; k++){
          //     if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
          //       return true;
          //     }
          //   }
          //   return false;
          //
          // });
          if(this.buscar){
          return this.itens.filter(res => {
            res = Object.values(res); // res esta transformando esta opcao em array, transformando o  metodo em valores
            for(let k = 0; k < res.length; k++){
              if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0){
                return true;
              }
            }
            return false;

          });
        }

          return lista;
        }
      }
    }
</script>
