<?php

use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\DepController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\PerfilController;
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

Route::get('/forgout', [ForgotPasswordController::class, 'forgout'])->name('forgout');
Route::get('/resetPassword', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::post('/sendMail', [ForgotPasswordController::class, 'sendMail'])->name('sendMail');
Route::get('/newPass/{hash}', [ForgotPasswordController::class, 'newPass'])->name('newPass');
Route::post('/updatePass', [ForgotPasswordController::class, 'updatePass'] )->name('updatePass');

Route::middleware(['auth'])->group(function () {
    Route::get('/painel', [DashController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [DashController::class, 'logout'])->name('logout');

    Route::get('/dep', [DepController::class,'dep'])->name('dep');
    Route::post('dep', [DepController::class,'addDep'])->name('addDep');
    Route::get('/dep/excluir/{id}', [DepController::class, 'deleteDep'])->name('deleteDep');
    Route::put('/dep/edit/{id}', [DepController::class, 'editDep'])->name('dep.edit');
    Route::get('/dep/show/{id}', [DepController::class, 'show'])->name('dep.show');

    Route::get('/atend', [AtendenteController::class, 'atend'])->name('atend');
    Route::post('atend', [AtendenteController::class, 'addAtend'])->name('addAtend');
    Route::post('/atendentes/{id}',[AtendenteController::class, 'tendDelete'])->name('atendDestroy');
    Route::put('/atend/edit/{id}', [AtendenteController::class, 'update'])->name('atend.edit');
    Route::get('/atend/show/{id}', [AtendenteController::class, 'show'])->name('atend.show');

    Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
    Route::post('contato',[ContatoController::class, 'contato_action'])->name('adicionar_contato');

    Route::get('/lead', [LeadsController::class, 'lead'])->name('lead');
    Route::post('lead', [LeadsController::class, 'addLead'])->name('addLead');
   
    Route::get('/perfil', [PerfilController::class, 'perfil'])->name('perfil');
    Route::post('/alterar-senha', [PerfilController::class, 'alterarSenha'])->name('alterarSenha');

    Route::get('/avaliacao', [AvaliacaoController::class, 'avaliacao'])->name('avaliacao');

    

}); 

