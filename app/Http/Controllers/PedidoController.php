<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProgramaController;
use App\Models\Pedido;
use App\Models\Programa;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function indexProapinho(){
        $ano = date('Y');
        $programas = Programa::where('tipo_prog', 'proapinho')->whereYear('created_at', $ano)->pluck('nom_prog');
        return view('controleProapinho')->with(compact('programas'));
    }

    public function postProapinho(Request $request){
        $ano = date('Y');
        $id_prog = ProgramaController::getIdProg($request->programa,'proapinho',$ano);
        $pedidos = Pedido::where('id_progfk', $id_prog)->where('tipo_ped',$request->tipo_ped)->get();
        $programas = Programa::where('tipo_prog', 'proapinho')->whereYear('created_at', $ano)->pluck('nom_prog');
        return view('controleProapinho')->with(compact('programas'))->with(compact('pedidos'));
    }

    public function indexProap(){
        $pedidos = Pedido::all();
        $ano = date('Y');
        $programas = Programa::where('tipo_prog', 'proap')->whereYear('created_at', $ano)->get();
        return view('pedidosProapinho')->with(compact('pedidos'))->with(compact('programas'));
    }

    public function cadastrarPedido(Request $request){
        $request->validate([
            'programa' => 'required|String|max:20',
            'tipo_prog' => 'required|String|max:9',
            'tipo_ped' =>'required|String|max:255',
            'n_ped' =>'required|integer|min:1|',
            'data' =>'required|Date|',
            'valor' =>'required|decimal:0,2|min:1',
            'n_pcdp' =>'required|String',
            'det' =>'required|String',
            'ben' =>'required|String|max:255',
           
        ]);
        $ano = Date('Y');
        $id_prog =ProgramaController::getIdProg($request->programa,$request->tipo_prog,$ano);

        $data = [
            'id_progfk' => $id_prog,
            'tipo_ped' => $request->tipo_ped,
            'num_ped' => $request->n_ped,
            'data' => $request->data,
            'val' => $request->valor*100,
            'pcdp' => $request->n_pcdp,
            'det' => $request->det,
            'ben' => $request->ben,
            'prest' => $request->prest,
        ];

        Pedido::create($data);
       
        return redirect('controleProapinho')->with('sucesso', 'Pedido cadastrado');
        
    }
}
