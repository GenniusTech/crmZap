<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Atendente;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {   
        $attendants = Atendente::select('nome', 'tell', 'dep', 'tipo', 'status','user_id')->get();

        $listReturn = [];
        foreach($attendants as $atend) {
            $user = User::select('email')->where('id', $atend->user_id)->first();
            $newAttend = [
                'nome' => $atend->nome,
                'tell' => $atend->tell,
                'dep' => $atend->dep,
                'tipo' => $atend->tipo,
                'status' => $atend->status,
                'email' => $user->email,
            ];
            $listReturn[] = $newAttend;
        }
        
        return response()->json($listReturn);
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
