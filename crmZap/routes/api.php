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

Route::get('AttendantList', [AttendantController::class, 'listAttendant'])->name('listAttendant');

Route::get('listdep', [AttendantController::class, 'dep'])->name('dep');

Route::post('addDep', [AttendantController::class, 'addDep'])->name('addDep');

Route::get('listContato', [AttendantController::class, 'listContato'])->name('listContato');

Route::post('addContato', [AttendantController::class, 'addContato'])->name('addContato');




