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
        $lista = [
            $attendants = Atendente::select('nome', 'tell', 'dep', 'tipo', 'status','user_id')->get(),
            $attendantsUser = User::select('email')->get()
        ];
        $lista = $attendants->map(function ($attendant) use ($attendantsUser) {
            
        $user = $attendantsUser->where('id', $attendant->id)->first();
        
        
            return [
                'nome' => $attendant->nome,
                'tell' => $attendant->tell,
                'dep' => $attendant->dep,
                'tipo' => $attendant->tipo,
                'status' => $attendant->status,
                'email' => $user->email
            ];
        });
        
        return response()->json($lista);

    
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
