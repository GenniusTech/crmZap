<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\ChatAvaliacao;
use App\Models\Dep;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvaliacaoController extends Controller
{   
   public function avaliacao(){
    $user = Auth::user();
    $avaliacao = [];
    $tipo =[];
    $contato = Atendente::where('user_id', $user->id)->first();
    if ($contato->tipo === 1) {
        $avaliacao = ChatAvaliacao::all();
        $tipo =1;
    } else if ($contato->tipo === 2) {
        
        $avaliacao = ChatAvaliacao::where('atendente_id', $user->id)->get();
    }
    foreach ($avaliacao as $avaliacoes) {
        $avaliacoes->dataCriacao = Carbon::parse($avaliacoes->created_at)->format('d/m/Y H:i:s');
    }
    return view('dashboard/avaliacao',['avaliacao' =>$avaliacao,'tipo'=>$tipo]);
   }
}
