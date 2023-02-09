<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;

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
        //return redirect('dashboard');
    }
    public function dashboard ()
    {
        return view('dashboard/dashboard');
    }

    public function login_action(Request $request){
        
        $credentials = $request->only(['email', 'senha']);
        
        $auth = [
            'email'=> $credentials['email'],
            'password' => $credentials['senha']
        ];

        if (Auth::guard('web')->attempt($auth)) {
            // Autenticação bem-sucedida
            return redirect()->intended('dashboard');
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
}
