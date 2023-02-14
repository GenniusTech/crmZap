<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
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
    
        if ($atendente->tipo === 1) {

           $atendentes = Atendente::where('tipo','1')->all();
           $contactsCount = $atendentes->contatos()->count();

        } else if ($atendente->tipo === 2) {

            $contactsCount = $atendente->contatos()->count();
            
        }
        $count_atendente = DB::table('crm_atendente')->count();
        
        return view('dashboard/dashboard',['contactsCount' => $contactsCount], ['count_atendente' => $count_atendente]);
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
