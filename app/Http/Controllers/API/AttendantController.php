<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Atendente;
use App\Models\Contato;
use App\Models\Dep;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAtendentes(): JsonResponse
    {
        $attendants = Atendente::select('nome', 'tell', 'dep', 'tipo', 'status', 'user_id')->get();

        $listReturn = [];
        foreach ($attendants as $atend) {
            $user = User::select('email')->where('id', $atend->user_id)->first();
            $newAttend = [
                'nome' => $atend->nome,
                'tell' => $atend->tell,
                'dep' => $atend->dep,
                'tipo' => $atend->tipo,
                'status' => $atend->status,
                'users' => $atend->user,
                'email' => $user->email,
                'created_at' => now()

            ];
            $listReturn[] = $newAttend;
        }

        return response()->json($listReturn);
    }


    public function listAtendentesId($id = null)
    {
        if ($id) {
            $atendente = Atendente::select('nome', 'tell', 'dep', 'tipo', 'status', 'user_id')
                ->where('id', $id)
                ->first();
            if (!$atendente) {
                return response()->json(['error' => 'Atendente não encontrado'], 404);
            }

            $user = User::select('email')->where('id', $atendente->user_id)->first();
            $newAttend = [
                'nome' => $atendente->nome,
                'tell' => $atendente->tell,
                'dep' => $atendente->dep,
                'tipo' => $atendente->tipo,
                'status' => $atendente->status,
                'user' => $atendente->user,
                'email' => $user->email
            ];

            return response()->json($newAttend);
        } else {
            $attendants = Atendente::select('nome', 'tell', 'dep', 'tipo', 'status', 'user_id')->get();

            $listReturn = [];
            foreach ($attendants as $atend) {
                $user = User::select('email')->where('id', $atend->user_id)->first();
                $newAttend = [
                    'nome' => $atend->nome,
                    'tell' => $atend->tell,
                    'dep' => $atend->dep,
                    'tipo' => $atend->tipo,
                    'status' => $atend->status,
                    'user' => $atend->user,
                    'email' => $user->email
                ];
                $listReturn[] = $newAttend;
            }

            return response()->json($listReturn);
        }
    }


    public function dellAtendente($id)
    {
        $user = User::find($id);
        if ($user) {
            $atendente = Atendente::where('user_id', $id)->first();
            if ($atendente) {
                if ($atendente->delete() && $user->delete()) {
                    return response()->json(['type' => 'success']);
                } else {
                    return response()->json(['type' => 'error']);
                }
            } else {
                if ($user->delete()) {
                    return response()->json(['type' => 'success']);
                } else {
                    return response()->json(['type' => 'error']);
                }
            }
        } else {
            return response()->json(['type' => 'error', 'message' => 'Usuário não encontrado com esse id']);
        }
    }
    

    public function upAtendente($id, Request $request)
    {
        $atendente = Atendente::find($id);

        if (!$atendente) {
            return response()->json(['error' => 'Atendente não encontrado'], 404);
        }

        $user = User::where('id', $atendente->user_id)->first();
        $user->email = $request->input('email');

        $atendente->fill($request->all());

        if ($atendente->save() && $user->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function dep(): JsonResponse
    {
        $listdep = Dep::select('nome', 'segmento', 'resp', 'status', 'id',)->get();

        $listReturn = [];
        foreach ($listdep as $dep) {

            $newDep = [
                'id' => $dep->id,
                'nome' => $dep->nome,
                'segmento' => $dep->segmento,
                'resp' => $dep->resp,
                'tipo' => $dep->tipo,
                'status' => $dep->status,

            ];
            $listReturn[] = $newDep;
        }

        return response()->json($listReturn);
    }


    public function addDep(Request $request)
    {
        $data = [
            'nome' => $request->input('nome'),
            'segmento' => $request->input('segmento'),
            'resp' => $request->input('resp'),
            'status' => $request->input('status'),
            'status' => $request->input('created_at'),
            'created_at' => now()
        ];

        try {
            $insert = DB::table('crm_dep')->insert($data);
            if ($insert) {
                return response()->json(['type' => true], 200);
            }
            return response()->json(['type' => false], 400);
        } catch (Exception $e) {
            return response()->json(['type' => false], 400);
        }
    }
    public function listContato(): JsonResponse
    {
        $listdep = Contato::select('id', 'nome', 'email', 'tell', 'empresa', 'profissao', 'instagram', 'facebook', 'created_at')->get();

        $listReturn = [];
        foreach ($listdep as $contato) {

            $newDep = [
                'id' => $contato->id,
                'nome' => $contato->nome,
                'email' => $contato->email,
                'tell' => $contato->tell,
                'empresa' => $contato->empresa,
                'profissao' => $contato->profissao,
                'instagram' => $contato->instagram,
                'facebook' => $contato->facebook,
                'created_at' => date($contato->created_at),
            ];
            $listReturn[] = $newDep;
        }

        return response()->json($listReturn);
    }
    public function listContatoId($id = null)
    {
        if ($id) {
            $contato = Contato::select('nome', 'email', 'tell', 'empresa', 'profissao', 'instagram', 'facebook')
                ->where('id', $id)
                ->first();
            if (!$contato) {
                return response()->json(['error' => 'Atendente não encontrado'], 404);
            }

            $newAttend = [
                'nome' => $contato->nome,
                'email' => $contato->email,
                'tell' => $contato->tell,
                'empresa' => $contato->empresa,
                'profissão' => $contato->profissão,
                'instagram' => $contato->instagram,
                'facebook' => $contato->facebook,
            ];

            return response()->json($newAttend);
        } else {
            $contato = Atendente::select('nome', 'email', 'tell', 'empresa', 'profissao', 'instagram', 'facebook')->get();

            $listReturn = [];
            foreach ($contato as $contato) {
                $newAttend = [
                    'nome' => $contato->nome,
                    'email' => $contato->email,
                    'tell' => $contato->tell,
                    'empresa' => $contato->empresa,
                    'profissão' => $contato->profissão,
                    'instagram' => $contato->instagram,
                    'facebook' => $contato->facebook,
                ];
                $listReturn[] = $newAttend;
            }

            return response()->json($listReturn);
        }
    }

    public function addContato(Request $request)
    {

        $data = [
            'id' => $request->input('id'),
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'tell' => $request->input('tell'),
            'empresa' => $request->input('empresa'),
            'profissao' => $request->input('profissao'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'atendente_id' => $request->input('atendente_id'),
            'created_at'=> now()

        ];

        try {
            $insert = DB::table('crm_contato')->insert($data);
            if ($insert) {
                return response()->json(['type' => true], 200);
            }

            return response()->json(['type' => false], 400);
        } catch (Exception $e) {

            return response()->json(['type' => false], 400);
        }
    }



    public function deleteContato($id)
    {
        $contato = Contato::find($id);
        if ($contato->delete()) {
            return response()->json(['type' => 'success']);
        } else {
            return response()->json(['type' => 'error']);
        }
    }
  
}
