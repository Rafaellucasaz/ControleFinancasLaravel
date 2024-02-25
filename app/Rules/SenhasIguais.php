<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SenhasIguais implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $passwordConfirm;
     public function __construct($passwordConfirm)
     {
         $this->passwordConfirm = $passwordConfirm;
     }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        if($value !== $this->passwordConfirm) {
            $fail('Senhas não idênticas');
        }
    }
}
