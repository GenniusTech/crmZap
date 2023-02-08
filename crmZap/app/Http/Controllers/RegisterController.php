<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
       $validator = $request->validate([
        'email' => 'required|email',
        'senha' => 'required|min:6',

       ]);
       
    }

    public function register(Request $request)
    {
        return view('signup');
    }

    public function register_action(Request $request)
    {   
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:atendente',
            'tell' =>'required',
            'senha' => 'required|min:6'
        ]);

        $data = $request->only('nome','email','tell','senha');

        $data['senha'] = Hash::make($data['senha']);

        Atendente::create($data);

        return view('dashboard/dashboard');
        
    }
}
