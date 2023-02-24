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
        $tipo =[];
        if ($atend->tipo === 1) {
            $deplist = Dep::all();
            $atendente = Atendente::all();
            $tipo =1;
        } else if ($atend->tipo === 2) {
            $atendente  = Atendente::where('user_id', $user->id)->get();
            $deplist = Dep::where('atendente_id', $user->id)->get();
        }
        return view('dashboard/atend', ['atendente' => $atendente,'tipo'=>$tipo,'deplist'=>$deplist]);
    }
    public function addAtend(Request $request){
        DB::beginTransaction();
        

        try {
            // Cria o novo usuário na tabela users
            $user = new User();
            $user->email = $request->input('email');
            $user->nome = $request->input('nome');
            $user->password = Hash::make($request->input('senha'));
            $user->save();
            $users = Auth::user();
            // Cria o novo atendente na tabela crm_atendentes
            $atendente = new Atendente();
            $atendente->nome = $request->input('nome');
            $atendente->email = $request->input('email');
            $atendente->tell = $request->input('tell');
            $atendente->dep = $request->input('dep');
            $atendente->user_id = $users->id;
            
            if ($request->input('status') == 1) {
                $status = 1;
            } else {
                $status = 2;
            }
            $atendente ->status = $status;
            if ($request->input('tipo') == 1) {
                $tipo = 1;
            } else {
                $tipo = 2;
            }
            $atendente ->tipo = $tipo;
            $atendente->save();

            DB::commit();

            return redirect('atend')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
           

            return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
        }
    }

    public function tendDelete($id)
    {
        $atendente = Atendente::find($id);
        if (!$atendente) {
            return redirect()->back()->with('error', 'Atendente não encontrado.');
        }
    
        $user = User::where('id', $atendente->id)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
    
        DB::beginTransaction();
    
        try {
            $atendente->delete();
            $user->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Atendente e usuário excluídos com sucesso.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir o atendente e usuário.');
        }
    }
    

    public function contato(Request $request){

        $user = Auth::user();
        $contato = Atendente::where('user_id', $user->id)->first();
        $tipo =[];
        if ($contato->tipo === 1) {
            $contatos = Contato::all();
            $tipo = 1;
        } else if ($contato->tipo === 2) {
            
            $contatos = Contato::where('atendente_id', $user->id)->get();
        }
        foreach ($contatos as $contato) {
            $contato->dataCriacao = Carbon::parse($contato->created_at)->format('d/m/Y H:i:s');
        }

        return view('dashboard/contatos',['contatos'=>$contatos,'tipo'=>$tipo]);
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

   
    

    public function perfil(){
        $user = Auth::user();
        $tipo =[];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
           
            $tipo =1;
        } else if ($contato->tipo === 2) {
            
           
        }
        return view('dashboard/perfil',['tipo'=>$tipo]);
    }

    public function fatura(){
        $user = Auth::user();
        $tipo =[];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
           
            $tipo =1;
        } else if ($contato->tipo === 2) {
            
           
        }
            return view('dashboard/fatura',['tipo'=>$tipo]);
    }
   
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
