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

class PerfilController extends Controller
{   

    public function perfil(){
        $user = Auth::user();
        $atend = Atendente::where('user_id', $user->id)->first();
        $tipo =[];
        if ($atend->tipo === 1) {
            $atendente = Atendente::select('tell', 'status')->where('user_id', $user->id)->first();
            
            $tipo =1;
        } else if ($atend->tipo === 2) {
            $atendente = Atendente::select('tell', 'status')->where('user_id', $user->id)->first();
            
        }
        return view('dashboard/perfil', ['atendente' => $atendente,'tipo'=>$tipo]);
    }

    public function alterarSenha(Request $request)
    {
        $user = Auth::user();
        $users = User::where('id',$user->id);
    
        // Verifique se o contato existe
        if(!$users) {
             return redirect('perfil')->with('error', 'Contato não encontrado.');
        }
    
        $user = User::findOrFail($user->id);
        $password = $request->input('senhaAnterior');
        $new_password = $request->input('novaSenha');
        $confirm_password = $request->input('confirmarSenha');
    
        if (!empty($password)) {
            // Verifique se a senha atual está correta
            if (Hash::check($password, $user->password)) {
                // Verifique se a nova senha e a confirmação correspondem
                if ($new_password === $confirm_password) {
                    $user->password = bcrypt($new_password);
                    $user->save();
                    return redirect('perfil')->with('success', 'Senha Alterada com Sucesso.');
                } else {
                    return response()->json(['success' => false, 'error' => 'A nova senha e a confirmação de senha não correspondem.']);
                }
            } else {
                return response()->json(['success' => false, 'error' => 'A senha atual está incorreta.']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'A senha atual não foi fornecida.']);
        }
    }
    
    
}
