<?php

namespace Atom\Core\Rules;

use Atom\Core\Models\WebsiteSetting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RegistrationEnabled implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $settings = WebsiteSetting::firstOrCreate(
            ['key' => 'disable_registration'],
            ['value' => 0, 'comment' => 'Determines whether registration is enabled or not (0 for no & 1 for yes)'],
        );

        if ((bool) $settings->value) {
            $fail('Registration is disabled.');
        }
    }
}
