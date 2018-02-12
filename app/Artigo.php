<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
