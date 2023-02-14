<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\AtendenteService;
use App\Services\ContatoService;
use App\Services\LeadsService;

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
    }

    public function dashboard (Request $request)
    {
        $user = Auth::user();
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
            'atendentes'=>$this->atendentes
            ]
        );
    }

    public function setInfosByTipo($atendente) {
        if ($atendente->tipo === 1) {
            $this->contactsCount = $this->contatoService->getAll()->count();
            $this->leadsCount = $this->leadsService->getLeadsByStatus('3')->count();
            $this->leadsStatusCount = $this->leadsService->getLeadsByStatus('1')->count();
            $this->tema = 'Atendentes';
            $this->tipo =1;
            $this->atendentes = Atendente::with(['leads'])->get();
        } else if ($atendente->tipo === 2) {
            $contacts = $this->contatoService->getByAtendenteId($atendente->id);
            $this->contactsCount = $contacts === null ? 0 : $contacts->count();
            $this->leadsCount = $this->leadsService->getLeadByStatusAndAtendenteId('3',$atendente->id)->count();
            $this->leadsStatusCount = $this->leadsService->getLeadByStatusAndAtendenteId('1',$atendente->id)->count(); 
            $this->tema = 'Equipe';
            $this->tipo =2;
        }
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
