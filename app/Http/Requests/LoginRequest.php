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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Both forms
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Je hebt je email niet ingevuld',
            'email.email' => 'Ongeldig email adres',
            'email.exists' => 'Ongeldig email adres',
            'password.required' => 'Je hebt je wachtwoord niet ingevuld',
        ];
    }
}
