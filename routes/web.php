<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/programas', [ProgramaController::class,'index'])->name('programas');

Route::post('/register/fodase', [LoginController::class,'registrar'])->name('a');

Route::post('/login/autenticar',[LoginController::class,'autenticar'])->name('autenticar');

Route::post('/programas/cadastrarNovoPrograma',[ProgramaController::class,'cadastrarNovoPrograma'])->name('cadastrarNovoPrograma');

