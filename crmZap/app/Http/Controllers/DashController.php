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
        if ($atendente->tipo === 1) {
            $contactsCount = DB::table('crm_contato')->count();
            $leadsCount = DB::table('crm_leads')->count();
            $tema = 'Atendentes';

        } else if ($atendente->tipo === 2) {

            $contactsCount = $atendente->contatos()->count();
            $leadsCount = $atendente->leads()->count();
            $tema = 'Equipe';
        }
        $count_atendente = DB::table('crm_atendente')->count();
        
        return view('dashboard/dashboard',
            ['contactsCount' => $contactsCount, 
            'count_atendente' => $count_atendente,
            'tema' => $tema,
            'leadsCount' => $leadsCount]
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
