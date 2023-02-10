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
    public function listAttendant(): JsonResponse
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
                'email' => $user->email
               
            ];
            $listReturn[] = $newAttend;
        }

        return response()->json($listReturn);
    }

    
    public function dep(): JsonResponse
    {
        $listdep = Dep::select( 'nome','segmento','resp','status','id',)->get();

        $listReturn = [];
        foreach ($listdep as $dep) {
    
            $newDep = [
                'id'=>$dep->id,
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
            'status' => $request->input('status')
        ];

        try {
            $insert = DB::table('crm_dep')->insert($data);
            if($insert){
            return response()->json(['type' => true], 200);
            }
            return response()->json(['type' => false], 400);
           
        } catch (Exception $e) {
            return response()->json(['type' => false], 400);
        }
    }
    public function listContato(): JsonResponse
    {
        $listdep = Contato::select( 'id','nome','email','tell','empresa','profissao','instagram','facebook')->get();

        $listReturn = [];
        foreach ($listdep as $contato) {
    
            $newDep = [
                'id'=>$contato->id,
                'nome' => $contato->nome,
                'email' => $contato->email,
                'tell' => $contato->tell,
                'empresa' => $contato->empresa,
                'profissao' => $contato->profissao,
                'instagram' => $contato->instagram,
                'facebook' => $contato->facebook,

            ];
            $listReturn[] = $newDep;
        }

        return response()->json($listReturn);
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
        
    ];
    
   

    try {
        $insert = DB::table('crm_contato')->insert($data);
        if($insert){
            return response()->json(['type' => true], 200);
        }

         return response()->json(['type' => false], 400);

    } catch (Exception $e) {

        return response()->json(['type' => false], 400);
    }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
