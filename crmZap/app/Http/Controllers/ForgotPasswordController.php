<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Dep;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterEmail;
use App\Models\PasswordReset;
use App\Services\PasswordService;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{   

    private $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function resetPassword() {
  
        return view('reset_mail');
    }

    public function forgout(Request $request)
    {
        return view('forgout');  
    }

    public function sendMail(Request $request) {

        try {
            $email = $request->get('email');
            $token = $request->get('_token');
            //Fazer validações 
    
            $hashToken = md5(md5(rand(1,1000).time(), rand(100,150).md5($email))).md5(strtoupper($email)).md5($token);  
            $verify = $this->passwordService->verifyEmailExistsToken($email);

            if ($verify) {
                return redirect()->back()->withErrors(['message' => 'Um link de recuperação já foi enviado para o seu e-mail anteriormente! Verique na caixa de entrada ou spam!']);
            }

            $user = User::where('email', $email)->get();

            if ($user->isEmpty()) {
                return redirect()->back()->withErrors(['message' => 'E-mail não encontrado na base de dados!']);
            } else {
                $registerTokenTable = $this->passwordService->registerTokenTable($hashToken, $email);
                if ($registerTokenTable) {
                    $testMailData = [
                        'title' => 'Recuperação de senha - '.env('MAIL_FROM_NAME', 'Grupo Sollution'),
                        'token' => $hashToken,
                        'nome'  => $user[0]->nome
                    ];
                    
                    Mail::to($email)->send(new RegisterEmail($testMailData));
                }

                return redirect()->back()->withErrors(['message' => 'E-mail de recuperação enviado!']);
            }
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Ocorreu um problema! Tente novamente mais tarde!']);
        }
    }

    public function newPass($hash) 
    {   
        $countHash = 0;
        $erro = null;

        if(!empty($hash)) {
            $countHash = PasswordReset::where('token', $hash)->get()->count();
        }

        if ($countHash === 0) {
            $erro = "O token está inválido ou expirado";
            $hash = "";
        }

        return view('reset_mail', compact('hash', 'erro'));
    }

    public function updatePass(Request $request)
    {
        $password = $request->get('password');
        $rePassword = $request->get('re_password');
        $token = $request->get('token');

        if ($password !== $rePassword) {
            return redirect()->back()->withErros(['message', 'Senhas não correspondem!']);
        }

        if (empty($password) || empty($rePassword)) {
            return redirect()->back()->withErros(['message', 'Todos os campos precisam ser preenchidos!']);
        }

        if (empty($token)) {
            $verifyToken = $this->passwordService->verifyIfExistsToken($token);
            if (!$verifyToken) {
                return redirect()->back()->withErros(['message', 'O token informado é inválido!']);
            }
        }

        $password = bcrypt($password);
        $getRow =  $this->passwordService->getRowByToken($token);
        if ($getRow) {
            $getUser = User::where('email', $getRow[0]->email)->get();
            if (!$getUser->isEmpty()) {
                $getUser[0]->update(
                    [
                        'password' => $password
                    ]
                );
                $this->passwordService->clearToken($token);
                return redirect()->route('login');
            }
        }

        return redirect()->back()->withErros(['message', 'Falha ao alterar as senhas! Tente novamente mais tarde!']);
    }
}
