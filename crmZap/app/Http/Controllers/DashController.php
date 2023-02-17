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
            $this->leadsCount = $this->leadsService->getLeadsByStatus('3')->count();
            $this->leadsStatusCount = $this->leadsService->getLeadsByStatus('1')->count();
            $this->tema = 'Atendentes';
            $this->tipo =1;
            $this->atendentes = Atendente::with(['leads'])->get();
        } else if ($atendente->tipo === 2) {
            $contacts = $this->contatoService->getByAtendenteId($atendente->id);
            $this->contatos = $contacts;//dd($this->contatos);
            $this->contactsCount = $contacts === null ? 0 : $contacts->count();
            $this->leadsCount = $this->leadsService->getLeadByStatusAndAtendenteId('3',$atendente->id)->count();
            $this->leadsStatusCount = $this->leadsService->getLeadByStatusAndAtendenteId('1',$atendente->id)->count(); 
            $this->tema = 'Equipe';
            $this->tipo =2;
        }
        
    }

   
    public function atend(){
        return view('dashboard/atend');
    }

    public function contato(Request $request){

        $user = Auth::user();
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $contatos = Contato::all();
        } else if ($contato->tipo === 2) {
            $novoContato = new Contato();
            $contatos = Contato::where('atendente_id', $user->id)->get();
        }

        return view('dashboard/contatos',['contatos'=>$contatos]);
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

    public function dep(){
        return view('dashboard/dep');
    }
    public function fatura(){
        return view('dashboard/fatura');
    }
    public function lead(){
        return view('dashboard/lead');
    }
    public function perfil(){
        return view('dashboard/perfil');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
