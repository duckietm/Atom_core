<?php

namespace Atom\Core\Http\Requests;

use Atom\Core\Rules\AccountLimit;
use Atom\Core\Rules\RegistrationEnabled;
use Atom\Core\Rules\UsernameDisabled;
use Atom\Core\Rules\ValidAddress;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9\-=?!@:,.]*$/', 'min:1', 'max:15', 'unique:users', new UsernameDisabled, new RegistrationEnabled, new AccountLimit, new ValidAddress],
            'mail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mail_confirmation' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,mail', 'same:mail'],
            'look' => ['sometimes', 'nullable'],
            'password' => ['required', 'string', new Password(8)],
            'password_confirmation' => ['required', 'string', new Password(8), 'same:password'],
            'cf-turnstile-response' => config('services.turnstile.enabled') ? ['required', Rule::turnstile()] : [],
            'terms' => ['sometimes', 'nullable', 'accepted'],
        ];
    }
}
