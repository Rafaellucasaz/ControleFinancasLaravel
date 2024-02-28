<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramaController;
use App\Models\Coordenador;
use App\Models\Login;
use App\Models\Programa;
use App\Rules\ProgramaExiste;
use App\Rules\ProgramaTemCoord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CoordenadorController extends Controller
{
    public function index(){
        $ano = getAno();
        $coordenadoresTemp = Coordenador::all();
        $coordenadores =[];
        $i = 0;
        foreach($coordenadoresTemp as $coordenador){
            $timestamp = Programa::where('id_prog',$coordenador->id_progfk)->value('created_at');
            $data = new Carbon($timestamp);
           array_push($coordenadores,[
            'id_log' => $coordenador->id_logfk,
            'coordenador' => $coordenador->nome,
            'username' => Login::where('id_log',$coordenador->id_logfk)->value('username'),
            'programa' => Programa::where('id_prog',$coordenador->id_progfk)->value('nom_prog') . "-" . $data->year ,
            'tipo' => Programa::where('id_prog',$coordenador->id_progfk)->value('tipo_prog')
           ]);
        }
        return view('coordenadores')->with(compact('coordenadores'));
    }
    public function indexConta($id_log,$id_prog){
        $timestamp = Programa::where('id_prog',$id_prog)->value('created_at');
        $data = new Carbon($timestamp);
        $tipo_prog = Programa::where('id_prog',$id_prog)->value('tipo_prog');
        if($tipo_prog == 'proapinho'){
            $tipo_prog = 'PAPG';
        }
        $infos =[
            'nome' => Coordenador::where('id_logfk',$id_log)->value('nome'),
            'username' => Login::where('id_log',$id_log)->value('username'),
            'programa' => Programa::where('id_prog',$id_prog)->value('nom_prog') . "-" . $data->year . "-" . strtoupper($tipo_prog)
        ];

        
        return view('conta')->with(compact('infos'));
    }
   

    public function cadastrarCoordenador(Request $request){
        $validator = Validator::make($request->all(), $rules = [
            'nome' => 'required|String|max:100|regex:/^[\pL\s]+$/u',
            'tipo_prog' =>'required',
            'nom_prog' =>['bail','required','String','max:20','regex:/^[a-zA-Z]+$/',new ProgramaExiste($request->tipo_prog), new ProgramaTemCoord($request->tipo_prog)],
            'username' =>['required','regex:/^[a-zA-Z0-9_-]+$/','min:3','max:25',Rule::unique('logins')],
            'password' => 'required|max:64',
        ],$msgs =[
            'required' => 'Este campo é obrigatório',
            'max' => 'Limite de caracteres atingido max: :max',
            'username.min'=> 'Nome de usuário precisa ter no mínimo 3 caracteres',	
            'nom_prog.regex' => 'Apenas caracteres de A-Z são permitidos',
            'username.regex' => 'Só pode conter letras, números, - e _',
            'nome.regex' => 'Nome só pode conter letras',
            'username.unique' => 'Nome de usuário não disponível',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ano = getAno();
        $id_prog = ProgramaController::getIdProg(strtoupper($request->nom_prog),$request->tipo_prog,$ano);
        $id_log = LoginController::registrar($request->username,$request->password,'coord');
        $data = [
            'id_logfk' => $id_log,
            'id_progfk' => $id_prog,
            'nome' => $request->nome,
        ];
                    
        Coordenador::create($data);
        return redirect()->route('coordenadores')->with('sucesso', 'Coordenador cadastrado');

    }

    public function excluirCoordenador($id_log){
        
        Coordenador::where('id_logfk',$id_log)->delete();
        LoginController::excluirLogin($id_log);
        return redirect()->route('coordenadores')->with('sucesso', 'Coordenador excluído');
    }

}
