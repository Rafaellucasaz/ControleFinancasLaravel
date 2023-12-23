<?php

use App\Http\Controllers\GraficoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramaController;
use App\http\Controllers\CoordenadorController;
use App\http\Controllers\PedidoController;
use App\Http\Controllers\RelatorioController;
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

    Route::delete('/programas/excluirPrograma/{id_prog}', [ProgramaController::class,'excluirPrograma'])->name('excluirPrograma');

    Route::patch('/programas/edicao',[ProgramaController::class,'edicao'])->name('edicao');

    Route::get('/coordenadores',[CoordenadorController::class,'index'])->name('coordenadores');

    Route::post('/coordenadores/cadastrarCoordenador',[CoordenadorController::class,'cadastrarCoordenador'])->name('cadastrarCoordenador');

    Route::delete('/coordenadores/excluirCoordenador/{id_log}', [CoordenadorController::class,'excluirCoordenador'])->name('excluirCoordenador');

    Route::get('/controleProapinho',[PedidoController::class,'indexProapinho'])->name('controleProapinho');

    Route::get('/controleProap',[PedidoController::class,'indexProap'])->name('controleProap');
    
    Route::post('/controleProapinho/cadastrarPedido',[PedidoController::class,'cadastrarPedido'])->name('cadastrarPedido');

    Route::get('/editarPedido/{id_ped}',[PedidoController::class,'indexEditarPedido'])->name('indexEditarPedido');

    Route::patch('/editarPedido',[PedidoController::class,'editarPedido'])->name('editarPedido');

    Route::delete('/excluirPedido/{id_ped}',[PedidoController::class,'excluirPedido'])->name('excluirPedido');
});


Route::group(['middleware' => 'coord'],function(){

    Route::get('/cadastrarValores/{id_prog}',[ProgramaController::class,'indexCadastrarValores'])->name('indexCadastrarValores');
    
    Route::patch('/cadastrarValores',[ProgramaController::class,'cadastrarValores'])->name('cadastrarValores');

    Route::get('/Pedidos/{id_prog}',[PedidoController::class,'indexPedidos'])->name('pedidos');
});

Route::group(['middleware' => 'auth'], function() {

    Route::get('/visualizarPedidos',[PedidoController::class,'getPedidos'])->name('getPedidos');
});


Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('/grafico',[GraficoController::class,'index'])->name('grafico');

Route::get('/grafico/pegarDados',[GraficoController::class,'getDados'])->name('dadosGraficos');

Route::get('/relatorio',[RelatorioController::class,'gerarRelatorio'])->name('relatorio');

Route::get('/getProgramas',[ProgramaController::class,'getProgramas'])->name('getProgramas');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login/autenticar',[LoginController::class,'autenticar'])->name('autenticar');

Route::post('/logout',[LoginController::class,'logout'])->name('logout');











