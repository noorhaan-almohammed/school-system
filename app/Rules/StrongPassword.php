<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(strlen($value) < 8){
            $fail('The password must be at least 8 characters long.');
            return ;
        }
        if(!preg_match('/[a-z]/',$value)){
            $fail('The password must contain at least one lowercase letter.');
            return ;
        }
        if(!preg_match('/[A-Z]/',$value)){
            $fail('The password must contain at least one uppercase letter.');
            return ;
        }
        if(!preg_match('/[0-9]/',$value)){
            $fail('The password must contain at least one number.');
            return ;
        }

    }
}
