<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coordenador;
use App\Models\Login;
use App\Models\Pedido;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramaController extends Controller
{
    public function index(){
        $anos = Programa::selectRaw('YEAR(created_at) as extract')->distinct()->pluck('extract');
        $programas = Programa::orderBy('tipo_prog','asc')->orderBy('created_at','asc')->orderBy('nom_prog','asc')->get();
        
        return view('programas')->with(compact('programas'))->with(compact('anos'));
    }

    public function indexCadastrarValores($id_prog){
        $programa = Programa::where('id_prog',$id_prog)->first();
        return view('valores')->with(compact('programa'));
    }

     public function cadastrarNovoPrograma(Request $request){
        $validator = Validator::make($request->all(),$rules =[
            'sigla' =>['required','regex:/^[a-zA-Z]+$/','max:20'],
            'tipo_prog' =>'required',
            ],$msgs = [
            'required' => 'Este campo é obrigatório',
            'regex' => 'Apenas caracteres de A-Z são permitidos',
            'max' => 'limite de caracteres atingido max: :max'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        
        $ano = date('Y');
        $programa = Programa::where('nom_prog',strtoupper($request->sigla))->where('tipo_prog',$request->tipo_prog)->whereYear('created_at',$ano)->first();
        if($programa === null){
            $data = [
                'nom_prog' => strtoupper($request->sigla),
                'tipo_prog' => $request->tipo_prog,
            ];
            Programa::create($data);
            return redirect()->route('programas')->with('sucesso', 'Programa cadastrado');
        }
        else{
            return redirect()->route('programas')->with('erro', 'Programa já cadastrado');
        }
    }

    public function excluirPrograma($id_prog)
    {
        Pedido::where('id_progfk',$id_prog)->delete();
        $id_log= Coordenador::where('id_progfk',$id_prog)->value('id_logfk');
        Coordenador::where('id_logfk',$id_log)->delete();
        Login::where('id_log',$id_log)->delete();
        Programa::where('id_prog',$id_prog)->delete();
        return redirect()->route('programas')->with('sucesso', 'Programa excluído');
    }

    public function cadastrarValores(Request $request){
        $validator = Validator::make($request->all(),$rules =[
            'dia_civ' => 'min:0',
            'dia_int' => 'min:0',
            'pass' => 'min:0',
            'sepe' => 'min:0',
            'nao_serv' => 'min:0',
            'aux_estu' => 'min:0',
            'aux_pesq' => 'min:0',
            'cons' => 'min:0',
            'ser_ter' => 'min:0',
            'tran' => 'min:0',
        ],$msgs =[
            'min' => 'Valor mínimo é :min'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $programa = Programa::find($request->id_prog);

        $programa->dia_civ = $request->dia_civ*100;
        $programa->dia_int = $request->dia_int*100;
        $programa->pass = $request->pass*100;
        $programa->sepe = $request->sepe*100;
        $programa->nao_serv = $request->nao_serv*100;
        $programa->aux_estu = $request->aux_estu*100;
        $programa->aux_pesq = $request->aux_pesq*100;
        $programa->cons = $request->cons*100;
        $programa->ser_ter = $request->ser_ter*100;
        $programa->tran = $request->tran*100;
        $programa->total = calcularTotalPrograma($programa);
        
        $programa->save();
     
        return redirect()->back()->with('sucesso','Valores cadastrados');
    }

    public function getProgramas(Request $request){
        if(isset($request->tipo_prog)){
            $programas = Programa::whereYear('created_at',$request->ano)->where('tipo_prog',$request->tipo_prog)->orderBy('nom_prog','asc')->get();
            return $programas;
        }
        $programas = Programa::whereYear('created_at',$request->ano)->orderBy('nom_prog','asc')->get();
        return $programas;
    }

    public function edicao(Request $request){
        if(isset($request->id_prog)){
            if
            ($request->edicao == "true"){
                Programa::where('id_prog',$request->id_prog)->update(['edit'=> true]);
                return redirect()->route('programas')->with('sucesso', 'Programa liberado para edição');
            }
            else{
                Programa::where('id_prog',$request->id_prog)->update(['edit'=> false]);
                return redirect()->route('programas')->with('sucesso', 'Programa trancado para edição');
            }
        }
        else{
            if
            ($request->edicao == "true"){
                $ano = date('Y');
                Programa::whereYear('created_at',$ano)->update(['edit'=> true]);
                return redirect()->route('programas')->with('sucesso', 'Programas liberados para edição');
            }
            else{
                $ano = date('Y');
                Programa::whereYear('created_at',$ano)->update(['edit'=> false]);
                return redirect()->route('programas')->with('sucesso', 'Programas trancados para edição');
            }
        } 
    }

    public static function getIdProg($programa,$tipo,$ano){
        return Programa::where('nom_prog',$programa)->where('tipo_prog',$tipo)->whereYear('created_at',$ano)->value('id_prog');
    }
}
