<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB; //Database: Query Builder

class Artigo extends Model
{
    use SoftDeletes;
// definir filabos
    protected $fillable = ['titulo','descricao','conteudo','data'];

    protected $dates = ['deleted_at'];

    public function user()// quando chamar user ele vai saber qual metodo que faz parte da relaçao.
    {
      return $this->belongsTo('App\User');
    }
    public static function listaArtigos($paginate)
    {
      /*
      $listaArtigos = Artigo::select('id','titulo','descricao','user_id','data')->paginate($paginate);
          foreach ($listaArtigos as $key => $value) {
          $value->user_id = User::find($value->user_id)->name;
        //  outra opcao e usar metodo de relacionamento para buscar autor
           //unset($value->user);
        }*/

        //usar Database: Query Builder --> Aula 52
        $user = auth()->user();
        if($user->admin == "S"){
          $listaArtigos = DB::table('artigos')
                          ->join('users','users.id','=','artigos.user_id')
                          ->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')
                          ->whereNull('deleted_at')
                          ->orderBy('artigos.id', 'DESC')
                          ->paginate($paginate);
        }else{
          $listaArtigos = DB::table('artigos')
                          ->join('users','users.id','=','artigos.user_id')
                          ->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')
                          ->whereNull('deleted_at')
                          ->where('artigos.user_id','=',$user->id)
                          ->orderBy('artigos.id', 'DESC')
                          ->paginate($paginate);
        }

        return $listaArtigos;
    }
    public static function listaArtigosSite($paginate,$busca = null)
      {
        if($busca){
          $listaArtigos = DB::table('artigos')
                          ->join('users','users.id','=','artigos.user_id')
                          ->select('artigos.id','artigos.titulo','artigos.descricao','users.name as autor','artigos.data')
                          ->whereNull('deleted_at')
                          ->whereDate('data','<=',date('Y-m-d'))
                          ->where(function($query) use ($busca){
                            $query->orWhere('titulo','like','%'.$busca.'%')
                                  ->orWhere('descricao','like','%'.$busca.'%');
                          })
                          ->orderBy('data','DESC')
                          ->paginate($paginate);
        }else{
          $listaArtigos = DB::table('artigos')
                          ->join('users','users.id','=','artigos.user_id')
                          ->select('artigos.id','artigos.titulo','artigos.descricao','users.name as autor','artigos.data')
                          ->whereNull('deleted_at')
                          ->whereDate('data','<=',date('Y-m-d'))
                          ->orderBy('data','DESC')
                          ->paginate($paginate);
        }
        return $listaArtigos;
    }

}
