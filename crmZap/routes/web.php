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


Route::get('/', [RegisterController::class, 'index'])->name('login');
Route::post('/', [RegisterController::class, 'login_action'])->name('login_action');

Route::get('/signup', [RegisterController::class, 'register'])->name('register');
Route::post('/signup', [RegisterController::class, 'register_action'])->name('register_action');

Route::middleware(['auth'])->group(function () {
    Route::get('/painel', [DashController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [DashController::class, 'logout'])->name('logout');
});

