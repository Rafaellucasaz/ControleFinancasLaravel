<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Coordenador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }
    public function autenticar(Request $request){
        $credentials = $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9_-]{3,25}$/',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials,true)){
            $request->session()->regenerate();
            if(Auth::user()->tipo_log=='admin'){
                session(['tipo_log' => 'admin']);
                return redirect()->route('programas');
            }
            session(['tipo_log' => 'coord']);
            session(['id_prog' => Coordenador::where('id_logfk',Auth::user()->id_log)->value('id_progfk')]);
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

    public static function primeiroUser(){
        $data =[
            'username' => 'PROPPG_01',
            'password' => hash::make('J8#pZ4!oD*'),
            'tipo_log' => 'admin'
        ];
        
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

    public static function excluirLogin($username){
        Login::where('username',$username)->delete();
        
    }

    public static function getIdLog($username){
        return Login::where('username',$username)->value('id_log');
    }

}
