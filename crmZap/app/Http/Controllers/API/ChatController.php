<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChatAvaliacao;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function listAvaliacao(): JsonResponse
    {
        $listchat = ChatAvaliacao::select('id', 'cliente', 'atendente', 'nota', 'resumo', 'created_at')->get();

        $listReturn = [];
        foreach ($listchat as $contato) {

            $newchat = [
                'id' => $contato->id,
                'cliente' => $contato->cliente,
                'atendente' => $contato->atendente,
                'nota' => $contato->nota,
                'resumo' => $contato->resumo,
                'created_at' => date($contato->created_at),
            ];
            $listReturn[] = $newchat;
        }

        return response()->json($listReturn);
    }


    public function addAvaliacao(Request $request)
    {
        $data = [];
        $data = [
            'id' => $request->input('id'),
            'cliente' => $request->input('cliente'),
            'atendente' => $request->input('atendente'),
            'nota' => $request->input('nota'),
            'resumo' => $request->input('resumo'),
            'created_at'=> now()

        ];

        try {
            $insert = DB::table('chat_avaliacao')->insert($data);
            if ($insert) {
                return response()->json(['type' => true], 200);
            }

            return response()->json(['type' => false], 400);
        } catch (Exception $e) {

            return response()->json(['type' => false], 400);
        }
    }




  
}
