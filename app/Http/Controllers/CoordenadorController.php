<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramaController;
use App\Models\Coordenador;
use App\Models\Login;
use App\Models\Programa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CoordenadorController extends Controller
{
    public function index(){
        $ano = date('Y');
        $coordenadoresTemp = Coordenador::all();
        $coordenadores =[];
        $i = 0;
        foreach($coordenadoresTemp as $coordenador){
            $timestamp = Programa::where('id_prog',$coordenador->id_progfk)->value('created_at');
            $data = new Carbon($timestamp);
           array_push($coordenadores,[
            'coordenador' => $coordenador->nome,
            'username' => Login::where('id_log',$coordenador->id_logfk)->value('username'),
            'programa' => Programa::where('id_prog',$coordenador->id_progfk)->value('nom_prog') . "-" . $data->year ,
            'tipo' => Programa::where('id_prog',$coordenador->id_progfk)->value('tipo_prog')
           ]);
        }
        return view('coordenadores')->with(compact('coordenadores'));

    }

    public function cadastrarCoordenador(Request $request){
        $request->validate([
            'nome' => 'required|String|max:50',
            'tipoPrograma' =>'required',
            'programa' =>'required|String|max:20',
            'username' =>'required|String|max:25',
            'senha' => 'required',
        ]);

        $id_log = LoginController::getIdLog($request->username);
        if($id_log !== null){
            return redirect()->route('coordenadores')->with('erro','Nome de usuário já utilizado');
        }
        else{
            $ano = date('Y');
            $id_prog = ProgramaController::getIdProg($request->programa,$request->tipoPrograma,$ano);
            if($id_prog === null){
                return redirect()->route('coordenadores')->with('erro','Programa não existe');
            }
            else{
               $coordenador =  Coordenador::where('id_progfk',$id_prog)->first();
               if($coordenador === null){
                $id_log = LoginController::registrar($request->username,$request->password,'coord');
                    $data = [
                        'id_logfk' => $id_log,
                        'id_progfk' => $id_prog,
                        'nome' => $request->nome,
                    ];
                    
                    Coordenador::create($data);
                    return redirect()->route('coordenadores')->with('sucesso', 'Coordenador cadastrado');
               }
               else{
                    return redirect()->route('coordenadores')->with('erro', ' O Programa já tem um coordenador responsável');
               }
            }
        }
        
        

       
    }

    public function excluirCoordenador($username){
        $id = LoginController::getIdLog($username);
        Coordenador::where('id_logfk',$id)->delete();
        LoginController::excluirLogin($username);
        return redirect()->route('coordenadores')->with('sucesso', 'Coordenador excluído');
    }

}
