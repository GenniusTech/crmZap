<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class LeadsController extends Controller
{   
 
    public function lead(){
        $user = Auth::user();
        $leadlist = [];
        $tipo =[];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $leadlist = Lead::all();
            $tipo =1;
        } else if ($contato->tipo === 2) {
            
            $leadlist = Lead::where('atendente_id', $user->id)->get();
        }
        foreach ($leadlist as $lead) {
            $lead->dataCriacao = Carbon::parse($lead->created_at)->format('d/m/Y H:i:s');
        }

        return view('dashboard/lead',['leadlist'=>$leadlist,'tipo'=>$tipo]);
    }
    public function addLead(Request $request){
        $contato='não definido';
        $user = Auth::user();
        $contato = new Lead();
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->tell = $request->input('tell');
        $contato->origem = $request->input('origem');
        $contato->status = 1;
        $contato->atendente_id = $user->id;
        $contato->save();
    
        return redirect('lead')->with('success', 'Contato adicionado com sucesso!');
    }

   
    

}
