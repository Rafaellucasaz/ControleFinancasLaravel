<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
    public function index(){
    
        return view('grafico');
    }

    public function getDados(Request $request){
        $programa = Programa::where('id_prog',$request->programa)->first();
        
        $pedidos = Pedido::select("tipo_ped","val")->where('id_progfk',$request->programa)->get();

        $valores = [
            'dia_civ' => calcularTotalPedidos('dia_civ',$pedidos),
            'dia_int' => calcularTotalPedidos('dia_int',$pedidos),
            'pass' => calcularTotalPedidos('pass',$pedidos),
            'sepe' => calcularTotalPedidos('sepe',$pedidos),
            'nao_serv' => calcularTotalPedidos('nao_serv',$pedidos),
            'aux_extu' => calcularTotalPedidos('aux_estu',$pedidos),
            'aux_pesq' => calcularTotalPedidos('aux_pesq', $pedidos),
            'cons' => calcularTotalPedidos('cons',$pedidos),
            'ser_ter' => calcularTotalPedidos('ser_ter',$pedidos),
            'tran' => calcularTotalPedidos('tran',$pedidos)
        ];
        return array('programa' => $programa, 'valores' => $valores);
    }
}
