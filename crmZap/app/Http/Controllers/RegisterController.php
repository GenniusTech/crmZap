<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Contato;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{   
    private $registerServices;

    public function __construct(RegisterService $classRegister)
    {
        $this->registerServices = $classRegister;

       
    }

    public function index(Request $request)
    {
        return view('signin');
       
    }
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

    public function login_action(Request $request){
        
        $credentials = $request->only(['email', 'senha']);
        $auth = [
            'email'=> $credentials['email'],
            'password' => $credentials['senha']
        ];

        if (Auth::guard('web')->attempt($auth)) {
            // Autenticação bem-sucedida
            return redirect()->route('dashboard');
        } else {
            // Autenticação falha
            return redirect()->back()->withInput()->withErrors(['email' => 'As credenciais fornecidas são inválidas.']);
        }
    }

    public function register(Request $request)
    {
        return view('signup');
    }

    public function register_action(Request $request)
    {   
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:users',
            'tell' =>'required',
            'senha' => 'required|min:6'
        ]);

        $dataUser = [
            'email' => $request->get('email'),
            'password'=> bcrypt($request->get('senha'))
        ];

        $userCreate = User::create($dataUser);

        if ($userCreate) {
            $dataAtendente = [
                'nome' => $request->get('nome'),
                'tell' => $request->get('tell'),
                'user_id' => $userCreate->id,
                'status' => 2,
                'tipo' => 2
            ];
            
            Atendente::create($dataAtendente);
            return view('dashboard/dashboard');
        }

        redirect()->back()->withErrors('Erro! Falha ao cadastrar o usuário!');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');//
    }
}
