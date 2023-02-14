<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{

    public function dashboard (Request $request)
    {
        
        $user = Auth::user();
        $atendente = Atendente::where('user_id',$user->id)->first();
        $contactsCount = 0 ;
        $leadsCount = 0 ;
        $tema = 'Atendente';
        $tipo = null;
        if ($atendente->tipo === 1) {
            $contactsCount = DB::table('crm_contato')->count(); //contatos
            $leadsCount = DB::table('crm_leads')->where('status', '=', '3')->count();//leads
            $leadsStatusCount = DB::table('crm_leads')->where('status' ,'=','1')->count();
            $tema = 'Atendentes';
            $tipo =1;

        } else if ($atendente->tipo === 2) {
            $contactsCount =DB::table('crm_contato')->where('atendente_id', '=', '2')->count();//contatos
            $leadsCount = DB::table('crm_leads')->where('status', '=', '3')->where('atendente_id', '=', '2')->count();
            $leadsStatusCount = DB::table('crm_leads')->where('status', '=', '1')->where('atendente_id', '=', '2')->count(); 
            $tema = 'Equipe';
            $tipo =2;
        }
        
        $count_atendente = DB::table('crm_atendente')->count();
        
        return view('dashboard/dashboard',
            ['contactsCount' => $contactsCount, 
            'count_atendente' => $count_atendente,
            'tema' => $tema,
            'leadsCount' => $leadsCount,
            'leadsStatusCount'=>$leadsStatusCount,
            'tipo' => $tipo
            ]
        );
    }

    public function carousel_atendente (Request $request)
    {
        
       
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
