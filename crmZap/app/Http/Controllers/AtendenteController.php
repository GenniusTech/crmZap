<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Dep;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AtendenteController extends Controller
{   
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
            $password = $request->input('senha');
            if (!empty($password)) {
                $user->password = bcrypt($password);
                $user->save();
            }
            $users = Auth::user();
            // Cria o novo atendente na tabela crm_atendentes
            $atendente = new Atendente();
            $atendente->nome = $request->input('nome');
            $atendente->email = $request->input('email');
            $atendente->tell = $request->input('tell');
            $atendente->dep = $request->input('dep');
            $atendente->user_id = $user->id;
            $atendente->ref_id = $users->id;
            
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

    public function show($id) {
        $userLogged = Auth::user();
        $atend = Atendente::where('id', $id)->get();
        if (empty($atend)) {
            return response()->json(['message' => 'Nenhum atendene encontrado!', 'data' => []], 404);
        }
        return response()->json(['message' => 'Retornado com sucesso!', 'data' => $atend], 200);
    }

    public function update(Request $request, $id) {
        $user = Auth::user();
        $atendente = Atendente::find($id);

        // Verifique se o contato existe
        if(!$atendente) {
             return redirect('atend')->with('error', 'Contato não encontrado.');
        }

        $user = User::findOrFail($atendente->user_id);
        $dep = Atendente::findOrFail($id);
        $dep->nome = $request->input('nome');
        $dep->email = $request->input('email');
        $dep->tell = $request->input('tell');
        $dep->dep = $request->input('dep');
        $dep->tipo = $request->input('tipo');
        $dep->status = $request->input('status');
        $password = $request->input('senha');

        if (!empty($password)) {
            $user->password = bcrypt($password);
            $user->save();
        }
        $dep->save();
        return response()->json(['success' => true]);
    }

    public function tendDelete($id)
    {
        $atendente = Atendente::find($id);
        if (!$atendente) {
            return redirect()->back()->with('error', 'Atendente não encontrado.');
        }
    
        $user = User::where('id', $atendente->user_id)->first();
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
}
