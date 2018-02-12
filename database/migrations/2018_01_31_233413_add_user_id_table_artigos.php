<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdTableArtigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('artigos', function (Blueprint $table) {
        // incluir o migrate de Artigos / unsigned quer dizer que vai receber somente numeros positivos / default p/ valor padrao
        $table->integer('user_id')->unsigned()->default(1);
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//onDelete cascade aceito varios Bancos BD - cuida da quebra do sistema no banco de dados
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //desfazer
        Schema::table('artigos', function (Blueprint $table) {
          $table->dropForeign(['user_id']);
          $table->dropColumn('user_id');
      });
    }
}
