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
use Illuminate\Support\Facades\Hash;

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

   
    public function atend() {
        $user = Auth::user();
        $atend = Atendente::where('user_id', $user->id)->first();
        if ($atend->tipo === 1) {
            $atendente = DB::table('crm_atendente')
                        ->join('users', 'users.id', '=', 'crm_atendente.user_id')
                        ->select('users.*', 'crm_atendente.*')
                        ->get();
        } else if ($atend->tipo === 2) {
            $atendente = DB::table('crm_atendente')
            ->join('users', 'users.id', '=', 'crm_atendente.user_id')
            ->select('users.*', 'crm_atendente.*')
            ->where('crm_atendente.user_id', '=', $user->id)
            ->get();
        }
        return view('dashboard/atend', ['atendente' => $atendente]);
    }
    public function addAtend(Request $request){
        DB::beginTransaction();
        
        try {
            // Cria o novo usuário na tabela users
            $user = new User();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('senha'));
            $user->save();
            $users = Auth::user();
            // Cria o novo atendente na tabela crm_atendentes
            $atendente = new Atendente();
            $atendente->nome = $request->input('nome');
            $atendente->tell = $request->input('tell');
            $atendente->dep = $request->input('dep');
            $atendente->user_id = $users->id;
            $atendente ->status = 2;
            $atendente ->tipo = 2;
            $atendente->save();

            DB::commit();

            return redirect('atend')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
        }
    }
    
    
    

    public function contato(Request $request){

        $user = Auth::user();
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $contatos = Contato::all();
        } else if ($contato->tipo === 2) {
            
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

    public function dep(Request $request){
        $user = Auth::user();
        $deplist = [];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $deplist = Dep::all();
        } else if ($contato->tipo === 2) {
            
            $deplist = Dep::where('atendente_id', $user->id)->get();
        }
        
        return view('dashboard/dep',['deplist' =>$deplist]);
    }
    public function addDep(Request $request){
        $contato='não definido';
        $user = Auth::user();
        $contato = new Dep();
        $contato->nome = $request->input('nome');
        $contato->segmento = $request->input('segmento');
        $contato->resp = $request->input('resp');
        $contato->status = $request->input('status');
        $contato->atendente_id = $user->id;
        $contato->save();
    
        return redirect('dep')->with('success', 'Contato adicionado com sucesso!');
    }
   
    public function lead(){
        $user = Auth::user();
        $leadlist = [];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $leadlist = Lead::all();
        } else if ($contato->tipo === 2) {
            
            $leadlist = Lead::where('atendente_id', $user->id)->get();
        }

        return view('dashboard/lead',['leadlist'=>$leadlist]);
    }
    public function addLead(Request $request){
        $contato='não definido';
        $user = Auth::user();
        $contato = new Lead();
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->tell = $request->input('tell');
        $contato->origem = $request->input('origem');
        $contato->status = 0;
        $contato->atendente_id = $user->id;
        $contato->save();
    
        return redirect('lead')->with('success', 'Contato adicionado com sucesso!');
    }
    

    public function perfil(){
        return view('dashboard/perfil');
    }

    public function fatura(){
            return view('dashboard/fatura');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
