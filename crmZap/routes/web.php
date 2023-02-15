<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rotas futuras para colocar dentro da org de pós logado
Route::view('/leads', 'dashboard.lead');

Route::get('/', [RegisterController::class, 'index'])->name('login');
Route::post('/', [RegisterController::class, 'login_action'])->name('login_action');

Route::get('/signup', [RegisterController::class, 'register'])->name('register');
Route::post('/signup', [RegisterController::class, 'register_action'])->name('register_action');

Route::middleware(['auth'])->group(function () {
    Route::get('/painel', [DashController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [DashController::class, 'logout'])->name('logout');
    Route::get('/dep',      [DashController::class, 'dep'])->name('dep');
    Route::get('/atend',    [DashController::class, 'atend'])->name('atend');
    Route::get('/contato', [DashController::class, 'contato'])->name('contato');
    Route::get('/fatura', [DashController::class, 'fatura'])->name('fatura');
    Route::get('/lead', [DashController::class, 'lead'])->name('lead');
    Route::get('/perfil', [DashController::class, 'perfil'])->name('perfil');
}); 

