<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artigo;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //referente ao component bootstrap que indica paginas - migalhas
      $listaMigalhas = json_encode([
        ["titulo"=>"Admin","url"=>""]
      ]);

      $totalUsuarios = User::count();;
      $totalArtigos = Artigo::count();
      $totalAutores = User::where('autor','=','S')->count();;
        //return view('home',compact('listaMigalhas','totalUsuarios','totalArtigos','totalAutores'));
        return view('admin',compact('listaMigalhas','totalUsuarios','totalArtigos','totalAutores'));
    }
}