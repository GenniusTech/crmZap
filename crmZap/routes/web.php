<?php


use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/painel',   [RegisterController::class, 'dashboard'])->name('dashboard');
    Route::get('/lead',     [RegisterController::class, 'lead'])->name('lead');
    Route::get('/dep',      [RegisterController::class, 'dep'])->name('dep');
    Route::get('/atend',    [RegisterController::class, 'atend'])->name('atend');
    Route::get('/contato', [RegisterController::class, 'contato'])->name('contato');
    Route::get('/logout',   [RegisterController::class, 'logout'])->name('logout');
});

