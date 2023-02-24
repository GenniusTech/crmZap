<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Dep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepController extends Controller
{   
    public function dep(Request $request){
        $user = Auth::user();
        $deplist = [];
        $tipo =[];
        $contato = Atendente::where('user_id', $user->id)->first();
        if ($contato->tipo === 1) {
            $deplist = Dep::all();
            $tipo =1;
        } else if ($contato->tipo === 2) {
            
            $deplist = Dep::where('atendente_id', $user->id)->get();
        }
        
        return view('dashboard/dep',['deplist' =>$deplist,'tipo'=>$tipo]);
    }

    public function addDep(Request $request){
        $contato='não definido';
        $user = Auth::user();
        $contato = new Dep();
        $contato->nome = $request->input('nome');
        $contato->segmento = $request->input('segmento');
        $contato->resp = $request->input('resp');
        $contato->status = $request->input('status');
        $contato->atendente_id = $user->id;
        $contato->save();
            
        return redirect('dep')->with('success', 'Contato adicionado com sucesso!');
    }

    public function editDep(Request $request, $id) {
        $user = Auth::user();
        $contato = Dep::find($id);

        // Verifique se o contato existe
        if(!$contato) {
             return redirect('dep')->with('error', 'Contato não encontrado.');
        }

        $dep = Dep::findOrFail($id);
        $dep->nome = $request->input('nome');
        $dep->segmento = $request->input('segmento');
        $dep->resp = $request->input('resp');
        $dep->status = $request->input('status');
        // $dep->ativo = $request->input('ativo');
        // $dep->listar = $request->input('listar');
        $dep->save();

        return response()->json(['success' => true]);
    }


    public function show($id) {
        $userLogged = Auth::user();
        $dep = Dep::where('id', $id)->get();
        if (empty($dep)) {
            return response()->json(['message' => 'Nenhum departamento encontrado!', 'data' => []], 404);
        }
        return response()->json(['message' => 'Retornado com sucesso!', 'data' => $dep], 200);
    }

     public function deleteDep($id)
    {
        $dep = Dep::find($id);
        if ($dep) {
            $dep->delete();
            return redirect()->back()->with('success', 'Departamento excluído com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Departamento não encontrado.');
        }
    }

}
