<?php

namespace Atom\Core\Rules;

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteSetting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AccountLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $settings = WebsiteSetting::firstOrCreate(
            ['key' => 'max_accounts_per_ip'],
            ['value' => 2],
        );

        $users = User::where('ip_current', request()->ip())
            ->orWhere('ip_register', request()->ip())
            ->count();

        if ($users >= $settings->value) {
            $fail('You have reached the max amount of allowed account');
        }
    }
}
