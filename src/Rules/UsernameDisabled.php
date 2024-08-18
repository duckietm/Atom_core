<?php

namespace Atom\Core\Rules;

use Atom\Core\Models\BannedUsername;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameDisabled implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $failed = BannedUsername::all()
            ->some(fn (BannedUsername $bannedUsername) => str_contains(strtolower($value), strtolower($bannedUsername->username)));

        if ($failed) {
            $fail("The {$attribute} field contains a disallowed word.");
        }
    }
}
