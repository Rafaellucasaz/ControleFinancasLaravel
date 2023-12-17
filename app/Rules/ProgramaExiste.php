<?php

namespace App\Rules;

use App\Http\Controllers\ProgramaController;
use App\Models\Programa;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProgramaExiste implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * 
     */
    protected $tipo_prog;
    public function __construct($tipo_prog)
    {
        $this->tipo_prog = $tipo_prog;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ano = getAno();
        if(!Programa::where('id_prog',ProgramaController::getIdProg(strtoupper($value),$this->tipo_prog,$ano))->exists()){
            $fail('O programa informado não existe');
        }
    }
}
