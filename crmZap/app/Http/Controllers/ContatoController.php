<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class ContatoController extends Controller
{   
   public function contato(Request $request){

    $user = Auth::user();
    $contato = Atendente::where('user_id', $user->id)->first();
    $tipo =[];
    if ($contato->tipo === 1) {
        $contatos = Contato::all();
        $tipo = 1;
    } else if ($contato->tipo === 2) {
        
        $contatos = Contato::where('atendente_id', $user->id)->get();
    }
    foreach ($contatos as $contato) {
        $contato->dataCriacao = Carbon::parse($contato->created_at)->format('d/m/Y H:i:s');
    }

    return view('dashboard/contatos',['contatos'=>$contatos,'tipo'=>$tipo]);
    }

    public function contato_action (Request $request){
    $contato='não definido';
    $user = Auth::user();
    $contato = new Contato();
    $contato->nome = $request->input('nome') . ' ' . $request->input('sobrenome');
    $contato->email = $request->input('email');
    $contato->tell = $request->input('tell');
    $contato->empresa = $request->input('empresa');
    $contato->profissao = $request->input('profissao');
    $contato->instagram = $request->input('instagram');
    $contato->facebook = $request->input('facebook');
    $contato->atendente_id = $user->id;

    $contato->save();

    return redirect('contato')->with('success', 'Contato adicionado com sucesso!');
    }

}