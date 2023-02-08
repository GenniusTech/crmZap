<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegisterService;

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

    public function register(Request $request)
    {
        return view('signup');
    }

    public function register_action(Request $request)
    {   
        $data = $request->only('nome','email','tell','senha');
        $create = $this->registerServices->store($data);
        return view('signin');
    }
}
