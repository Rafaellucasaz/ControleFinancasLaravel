<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Coordenador;
use Illuminate\Http\Request;
use App\Rules\SenhasIguais;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }
    public function autenticar(Request $request){
        $validator = Validator::make($request->all(), $rules = [
            'username' => 'required|regex:/^[a-zA-Z0-9_-]{3,25}$/',
            'password' => 'required|max:64',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('erro','usuário e/ou senha inválidos');
        }
        $credentials =[
            'username' => $request->username,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials,true)){
            $request->session()->regenerate();
            if(Auth::user()->tipo_log=='admin'){
                session(['tipo_log' => 'admin']);
                session(['id_log' => Auth::user()->id_log]);
                return redirect()->route('programas');
            }
            session(['tipo_log' => 'coord']);
            session(['id_prog' => Coordenador::where('id_logfk',Auth::user()->id_log)->value('id_progfk')]);
            session(['id_log' => Auth::user()->id_log]);
            return redirect()->route('indexCadastrarValores',session('id_prog'));
            
        }
        else{
            return redirect()->route('login')->with('erro','Usuário ou senha inválidos');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public static function registrar($username,$password,$tipoLog){

        
        $data = [
            'username' => $username,
            'password' => hash::make($password),
            'tipo_log' => $tipoLog,
        ];
        $username = Login::where('username',$username)->value('username');
        if($username === null){
            $login = Login::create($data);
            $id = $login->id_log;
            return $id;
        }
        else{
            return null;
        }

       
    }

    public function alterarSenha(Request $request){
        $validator = Validator::make($request->all(), $rules = [
            'password' => ['required','max:64', new SenhasIguais($request->passwordConfirm)],
            'passwordConfirm' => 'required|max:64',
        ],$msgs =[
            'required' => 'Este campo é obrigatório',
            'max' => 'Limite de caracteres atingido max: :max',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $login = Login::find($request->id_log);

        $login->password =  hash::make($request->password);
        $login->save();

        return redirect()->route('indexConta', ['id_log' => $request->id_log, 'id_prog' => $request->id_prog])->with('sucesso','senha alterada');
    }

    public static function excluirLogin($id_log){
        Login::where('id_log',$id_log)->delete();
        
    }

}
