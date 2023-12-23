<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProgramaController;
use App\Models\Pedido;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class PedidoController extends Controller
{
    public function indexProapinho(){
        $ano = getAno();
        $programas = Programa::where('tipo_prog', 'proapinho')->whereYear('created_at', $ano)->select('nom_prog','id_prog')->get();
        return view('controleProapinho')->with(compact('programas'));
    }

    public function indexProap(){
        $ano = getAno();
        $programas = Programa::where('tipo_prog', 'proap')->whereYear('created_at', $ano)->select('nom_prog','id_prog')->get();
        return view('controleProap')->with(compact('programas'));
    }

    public function indexPedidos($id_prog){
        $programa = Programa::where('id_prog',$id_prog)->first();
        return view('pedidos')->with(compact('programa'));
    }
   
    public function getPedidos(Request $request){
        $pedidos = Pedido::where('id_progfk', $request->id_prog)->where('tipo_ped',$request->tipo_ped)->orderBy('num_ped','ASC')->get();
        return $pedidos;
    }

   

    public function cadastrarPedido(Request $request){
       

        $validator = Validator::make($request->all(),$rules = [ 
            'num_ped' => ['bail',Rule::unique('pedidos')->where('id_progfk', $request->id_prog)->where('tipo_ped',$request->tipo_ped),'required','integer','min:1'],
            'data' =>'required|Date|',
            'val' =>'required|decimal:0,2|min:1',
            'pcdp' =>'required|String|max:9',
            'det' =>'required|String',
            'ben' =>'required|regex:/^[\pL\s]+$/u|max:50', 
        ],$msgs = [
          'required' =>  'Este campo é obrigatório',
          'num_ped.unique' => 'Pedido Nº' . $request->num_ped . ' já existe ',
          'max' => 'Limite de caracteres atingido max: :max',
          'min' => ' O mínimo para este valor é :min',
          'date' => 'Precisa estar no formato de data D-M-A',
          'decimal' => 'Valor só pode ter até duas casas decimais',
          'integer' => 'Precisa ser um valor inteiro',
          'regex' => 'Apenas letras são permitidas'
        ]);
        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        $data = [
            'id_progfk' => $request->id_prog,
            'tipo_ped' => $request->tipo_ped,
            'num_ped' => $request->num_ped,
            'data' => $request->data,
            'val' => $request->val*100,
            'pcdp' => $request->pcdp,
            'det' => $request->det,
            'ben' => $request->ben,
            'prest' => $request->prest,
        ];


        Pedido::create($data);
       
        return redirect()->back()->with(['sucesso' =>'Pedido cadastrado'])->withInput(['id_prog' => $request->id_prog, 'tipo_ped' => $request->tipo_ped]);
        
    }
    
    public function indexEditarPedido($id_ped){
        $pedido = Pedido::where('id_ped',$id_ped)->first();
        $programa = Programa::select('nom_prog','tipo_prog')->where('id_prog',$pedido->id_progfk)->first();
        return view('editarPedido')->with(['pedido' => $pedido, 'programa' => $programa]);
    }

    public function editarPedido(Request $request){
        $validator = Validator::make($request->all(),$rules =[
            'data' =>'required|Date|',
            'val' =>'required|decimal:0,2|min:1',
            'pcdp' =>'required|String|max:9',
            'det' =>'required|String',
            'ben' =>'required|regex:/^[\pL\s]+$/u|max:50', 
        ],$msgs = [
          'required' =>  'Este campo é obrigatório :attribute',
          'ben.max' => 'limite de caracteres atingido em beneficiado',
          'pcdp.max' => 'limite de caracteres atingido em pcdp',
          'min' => 'o mínimo para o valor é :min',
          'date' => 'Precisa estar no formato de data D-M-A',
          'decimal' => 'Valor só pode ter até duas casas decimais',
          'regex' => 'Beneficiado só pode conter letras'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pedido = Pedido::find($request->id_ped);
        if(!$pedido){
            return redirect()->back()->with('erro','pedido não encontrado');
        }
        $pedido->data= $request->data;
        $pedido->val = $request->val*100;   
        $pedido->pcdp = $request->pcdp;
        $pedido->det = $request->det;
        $pedido->ben = $request->ben;
        $pedido->save();
        
        if($request->tipo_prog === 'proap'){
            return redirect()->route('controleProap')->with(['sucesso' =>'Pedido editado'])->withInput(['id_prog' => $pedido->id_progfk, 'tipo_ped' => $pedido->tipo_ped]);
        }
        return redirect()->route('controleProapinho')->with(['sucesso' =>'Pedido editado'])->withInput(['id_prog' => $pedido->id_progfk, 'tipo_ped' => $pedido->tipo_ped]);
    }

    public function excluirPedido($id_ped){
        $pedido = Pedido::find($id_ped);

        if(!$pedido){
            return redirect()->back()->with('erro','pedido não encontrado');
        }
        $pedido->delete();
        $id_prog = $pedido->id_progfk;
        $programa = Programa::select('nom_prog','tipo_prog')->where('id_prog',$id_prog)->first();
        if($programa->tipo_prog === 'proap'){
            return redirect()->route('controleProap')->with(['sucesso' =>'Pedido deletado'])->withInput(['programa' => $programa->nom_prog, 'tipo_ped' => $pedido->tipo_ped]);
        }
        return redirect()->route('controleProapinho')->with(['sucesso' =>'Pedido deletado'])->withInput(['programa' => $programa->nom_prog, 'tipo_ped' => $pedido->tipo_ped]);

    }
}
