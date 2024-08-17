<?php

namespace Atom\Core\Rules;

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteSetting;
use Atom\Core\Models\WordFilter;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DisallowWordFilter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $failed = WordFilter::all()
            ->some(fn (WordFilter $wordFilter) => str_contains(strtolower($value), strtolower($wordFilter->key)));

        if ($failed) {
            $fail("The {$attribute} field contains a disallowed word.");
        }
    }
}
