<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Contato;
use App\Models\Dep;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\AtendenteService;
use App\Services\ContatoService;
use App\Services\LeadsService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class DashController extends Controller
{   
    private $atendenteService;
    private $leadsService;
    private $contatoService;
    private $contactsCount ;
    private $leadsCount = 0 ;
    private $tema;
    private $tipo = null;
    private $atendentes = [];
    private $leadsStatusCount;
    private $contatos;//1

    public function __construct(AtendenteService $atendente, 
                                LeadsService $lead,
                                ContatoService $contato)
    {
        $this->atendenteService = $atendente;
        $this->leadsService = $lead;
        $this->contatoService = $contato;
        $this->contactsCount = 0;
        $this->leadsCount = 0;
        $this->tema = "Atendente";
        $this->tipo = null;
        $this->atendentes = [];
        $this->leadsStatusCount = 0;
        $this->contatos = [];//2

    }

    public function dashboard (Request $request)
    {
        
        
        $user = Auth::user();
        $atendeinfor = Atendente::where('user_id', $user->id)->first();
        $nome = $atendeinfor->nome; 
        $email = $user->email; 

        $atendente = $this->atendenteService->getAtendenteByUserId($user->id);
        $getInfos = $this->setInfosByTipo($atendente);
        $count_atendente = $this->atendenteService->getAll()->count();

        return view('dashboard/dashboard',
            ['contactsCount' => $this->contactsCount, 
            'count_atendente' => $count_atendente,
            'tema' => $this->tema,
            'leadsCount' => $this->leadsCount,
            'leadsStatusCount'=>$this->leadsStatusCount,
            'tipo' => $this->tipo,
            'atendentes'=>$this->atendentes,
            'contatos'=>$this->contatos,
            'nome'=>$nome,
            'email'=>$email
            ]
        );
    }

    public function setInfosByTipo($atendente) {
        if ($atendente->tipo === 1) {
            $this->contatos = $this->contatoService->getAll();
            $this->contactsCount = $this->contatoService->getAll()->count();
            $this->leadsCount = $this->leadsService->getLeadsByStatus('1')->count();
            $this->leadsStatusCount = $this->leadsService->getLeadsByStatus('3')->count();
            $this->tema = 'Atendentes';
            $this->tipo =1;
            $this->atendentes = Atendente::with(['leads'])->get();
        } else if ($atendente->tipo === 2) {
            $contacts = $this->contatoService->getByAtendenteId($atendente->user_id);
            $this->contatos = $contacts;
            $this->contactsCount = $contacts === null ? 0 : $contacts->count();
            $this->leadsCount = $this->leadsService->getLeadByStatusAndAtendenteId('1',$atendente->user_id)->count();
            $this->leadsStatusCount = $this->leadsService->getLeadByStatusAndAtendenteId('3',$atendente->user_id)->count(); 
            $this->tema = 'Equipe';
            $this->tipo =2;
        }
        
    }

   
   
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
