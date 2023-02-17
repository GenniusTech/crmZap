<?php

use App\Http\Controllers\API\AttendantController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\ApiListaAtendenteController;
use App\Models\ChatAvaliazao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('listAtendentes', [AttendantController::class, 'listAtendentes'])->name('listAtendentes');
Route::get('listAtendentes/{id}', [AttendantController::class, 'listAtendentesId'])->name('listAtendentesId');
Route::put('upAtendente/{id}',[AttendantController::class,'upAtendente'])->name('upAtendente');
Route::delete('dellAtendente/{id}', [AttendantController::class, 'dellAtendente'])->name('dellAtendente');

Route::get('listdep', [AttendantController::class, 'dep'])->name('dep');
Route::post('addDep', [AttendantController::class, 'addDep'])->name('addDep');

Route::get('listContato', [AttendantController::class, 'listContato'])->name('listContato');
Route::get('listContato/{id}', [AttendantController::class, 'listContatoId'])->name('listContatoId');
Route::post('addContato', [AttendantController::class, 'addContato'])->name('addContato');
Route::delete('deleteContato/{id}', [AttendantController::class, 'deleteContato'])->name('deleteContato');

Route::get('listAvaliacao', [ChatController::class,'listAvaliacao'])->name('listAvaliacao');
Route::post('addAvaliacao', [ChatController::class,'addAvaliacao'])->name('addAvaliacao');
