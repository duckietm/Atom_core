<?php

namespace Atom\Core\Http\Requests;

use Atom\Core\Rules\AccountLimit;
use Atom\Core\Rules\RegistrationEnabled;
use Atom\Core\Rules\ValidAddress;
use Illuminate\Foundation\Http\FormRequest;
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
            'username' => ['required', 'string', 'alpha_num', 'min:3', 'max:255', 'unique:users', new RegistrationEnabled, new AccountLimit, new ValidAddress],
            'mail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mail_confirmation' => ['sometimes', 'nullable', 'email', 'max:255', 'same:mail'],
            'look' => ['sometimes', 'nullable'],
            'password' => ['required', 'string', new Password(8), 'confirmed'],
            'terms' => ['sometimes', 'nullable', 'accepted'],
        ];
    }
}
