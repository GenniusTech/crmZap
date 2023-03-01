<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Dep;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvaliacaoController extends Controller
{   
   public function avaliacao(){
    $user = Auth::user();
    $deplist = [];
    $tipo =[];
    $contato = Atendente::where('user_id', $user->id)->first();
    if ($contato->tipo === 1) {
        $deplist = Dep::all();
        $tipo =1;
    } else if ($contato->tipo === 2) {
        
        $deplist = Dep::where('atendente_id', $user->id)->get();
    }
    return view('dashboard/avaliacao',['deplist' =>$deplist,'tipo'=>$tipo]);
   }
}
