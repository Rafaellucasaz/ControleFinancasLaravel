<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coordenador;
use App\Models\Pedido;
use App\Models\Programa;
use Illuminate\Http\Request;



class ProgramaController extends Controller
{
    public function index(){
        $ano = date('Y');
        $programas = Programa::whereYear('created_at',$ano)->get();
        return view('programas')->with(compact('programas'));
    }

    public function cadastrarNovoPrograma(Request $request){
        $request->validate([
            'programa' =>'required|String|max:20',
            'tipoPrograma' =>'required',
        ]);
        $ano = date('Y');
    $programa = Programa::where('nom_prog',$request->programa)->where('tipo_prog',$request->tipoPrograma)->whereYear('created_at',$ano)->first();
        if($programa === null){
            $data = [
                'nom_prog' => strtoupper($request->programa),
                'tipo_prog' => $request->tipoPrograma,
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
        Coordenador::where('id_progfk',$id_prog)->delete();
        Programa::where('id_prog',$id_prog)->delete();
        return redirect()->route('programas')->with('sucesso', 'Programa excluído');

    }

    public function edicao(Request $request){
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

    public static function getIdProg($programa,$tipo,$ano){
        return Programa::where('nom_prog',$programa)->where('tipo_prog',$tipo)->whereYear('created_at',$ano)->value('id_prog');
    }
}
