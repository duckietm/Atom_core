<?php

namespace Atom\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidAddress implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! filter_var(request()->ip(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {
            $fail('Invalid IP address');
        }
    }
}
