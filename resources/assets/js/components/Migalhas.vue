<template>
  <!-- breadcrumb - Indique a localização da página atual dentro de uma hierarquia de navegação.(component bootstrap) -->
  <ol class="breadcrumb">
    <li v-for="item in lista"><a v-if="item.url" v-bind:class="defineClass" v-bind:href="item.url">{{item.titulo}}</a><span v-if="!item.url">{{item.titulo}}</span></li>
    <!-- <li class="active">Data</li> -->
  </ol>
</template>

<script>
    export default {
        props:['lista'],
        computed:{
          defineClass: function(){
            if(this.url){
              return "active";
            }else{
              return "";
            }
          }
        }
        // mounted:function(){
        //   console.log(this.lista);
        // }
    }
</script>
