<?php

use App\Http\Controllers\API\AttendantController;
use App\Http\Controllers\ApiListaAtendenteController;
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

Route::get('listContato', [AttendantController::class, 'contato']);

Route::get('listdep', [AttendantController::class, 'dep']);

Route::get('addContato', [AttendantController::class, 'index']);

Route::get('addDep', [AttendantController::class, 'index']);

