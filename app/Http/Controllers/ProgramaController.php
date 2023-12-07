<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            'programa' =>'required|String|max:10',
            'tipoPrograma' =>'required',
        ]);

        $data = [
            'nom_prog' => $request->programa,
            'tipo_prog' => $request->tipoPrograma,
        ];
        Programa::create($data);
        return redirect()->route('programas')->with('sucesso', 'programa cadastrado');

    }
}
