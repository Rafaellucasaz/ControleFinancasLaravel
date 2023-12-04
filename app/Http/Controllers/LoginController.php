<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function autenticar(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials,true)){
            $request->session()->regenerate();
            if(Auth::user()->tipo_log=='admin'){
                session('tipo_log') === 'admin';
                return redirect()->route('home');
            }
            return redirect()->route('login');
            
        }
        else{
            return redirect()->route('login')->with('error','Usuário ou senha inválidos');
        }
    }

    public function registrar(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'tipo_log' => $request->tipo,
        ];
        Login::create($data);
        return redirect()->route('home');
    }

}
