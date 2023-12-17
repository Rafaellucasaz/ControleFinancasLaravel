<?php

namespace App\Rules;

use App\Http\Controllers\ProgramaController;
use App\Models\Coordenador;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProgramaTemCoord implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $tipo_prog;
     public function __construct($tipo_prog)
     {
         $this->tipo_prog = $tipo_prog;
     }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ano = getAno();
        $id_prog = ProgramaController::getIdProg(strtoupper($value),$this->tipo_prog,$ano);
        if(Coordenador::where('id_progfk',$id_prog)->exists()){
            $fail('O programa informado já tem um coordenador responsável');
        }
    }
}
