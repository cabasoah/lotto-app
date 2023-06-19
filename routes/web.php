<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/game/add',[HomeController::class, 'addGame'])->name('game.store');
Route::get('/game/{id}/add-results',[HomeController::class, 'addResults'])->name('game.results');
Route::post('/game/{id}/store-results',[HomeController::class, 'storeResults'])->name('result.store');
Route::post('/game/results/update',[HomeController::class, 'updateResults'])->name('result.update');

