<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramaController;
use App\http\Controllers\CoordenadorController;
use App\http\Controllers\PedidoController;
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


Route::group(['middleware' => 'admin'],function(){

    Route::get('/programas', [ProgramaController::class,'index'])->name('programas');

    Route::post('/programas/cadastrarNovoPrograma',[ProgramaController::class,'cadastrarNovoPrograma'])->name('cadastrarNovoPrograma');

    Route::get('/programas/excluirPrograma/{id_prog}', [ProgramaController::class,'excluirPrograma'])->name('excluirPrograma');

    Route::post('/programas/edicao',[ProgramaController::class,'edicao'])->name('edicao');

    Route::get('/coordenadores',[CoordenadorController::class,'index'])->name('coordenadores');

    Route::post('/coordenadores/cadastrarCoordenador',[CoordenadorController::class,'cadastrarCoordenador'])->name('cadastrarCoordenador');

    Route::get('/coordenadores/excluirCoordenador/{username}', [CoordenadorController::class,'excluirCoordenador'])->name('excluirCoordenador');

    Route::get('/controleProapinho',[PedidoController::class,'indexProapinho'])->name('controleProapinho');

    Route::post('/controleProapinho',[PedidoController::class,'visualizarPedidosProapinho'])->name('viewPedidosProapinho');

    Route::get('/controleProap',[PedidoController::class,'indexProap'])->name('controleProap');
    
    Route::post('/controleProap/pedidos',[PedidoController::class,'visualizarPedidosProap'])->name('viewPedidosProap');

    Route::post('/controleProapinho/cadastrarPedido',[PedidoController::class,'cadastrarPedido'])->name('cadastrarPedido');

    Route::get('/editarPedido/{id_ped}',[PedidoController::class,'indexEditarPedido'])->name('indexEditarPedido');

    Route::post('/editarPedido',[PedidoController::class,'editarPedido'])->name('editarPedido');

    Route::get('/excluirPedido/{id_ped}',[PedidoController::class,'excluirPedido'])->name('excluirPedido');
});


Route::group(['middleware' => 'coord'],function(){

    Route::get('/cadastrarValores/{id_prog}',[ProgramaController::class,'indexCadastrarValores'])->name('indexCadastrarValores');
});



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login/autenticar',[LoginController::class,'autenticar'])->name('autenticar');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');











