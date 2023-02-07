<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request){
        return view('signin');
    }

    public function register(Request $request){
        return view('signup');
    }

    public function register_action(Request $request){
        $data = $request->only('nome','email','tell','senha');
        $atcreate = Atendente::create($data);
        return view('signin');
    }
}
