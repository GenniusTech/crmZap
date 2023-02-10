<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Atendente;
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
    public function contato(): JsonResponse
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
        DB::table('crm_dep')->insert($data);
        return response()->json(['type' => true], 200);
    } catch (Exception $e) {
        return response()->json(['type' => false], 500);
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
