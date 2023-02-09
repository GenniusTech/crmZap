<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
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
  

    public function login_action(Request $request){
        
       $validator = $request->only(['email', 'senha']);

       if (Auth::attempt($validator)) {
        // Autenticação bem-sucedida
        return redirect()->intended('dashboard');
    } else 
    {
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
            'email' => 'required|email|unique:crm_atendente',
            'tell' =>'required',
            'senha' => 'required|min:6'
        ]);

        $data = $request->only('nome','email','tell','senha','status','tipo');

        $data['senha'] = bcrypt($request->senha);
        $data['status'] = 2;
        $data['tipo'] = 2;
        Atendente::create($data);

        return view('dashboard/dashboard');
        
    }
}
