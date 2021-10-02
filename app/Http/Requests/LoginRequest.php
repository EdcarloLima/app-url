<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string'
        ];
    }

    /**
     * Show the validation message
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'Informe o e-mail',
            'email.email'       => 'Informe um e-mail válido',
            'password.required' => 'Informe a senha',
            'password.string'   => 'Informe a senha no formato de string'
        ];
    }
}
