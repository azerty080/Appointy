<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClient extends FormRequest
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
            //Client form
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'birthdate' => 'sometimes',



                 
            //Both forms
            'township' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required',
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|confirmed',        
        ];
    }





    
    public function messages()
    {
        return [
            //Client form
            'firstname.sometimes' => 'Je hebt je voornaam niet ingevuld',
            'firstname.string' => 'Je hebt je voornaam niet ingevuld',
            'firstname.max:255' => 'Je hebt je voornaam niet ingevuld',

            'lastname.sometimes' => 'Je hebt je achternaam niet ingevuld',
            'lastname.string' => 'Je hebt je achternaam niet ingevuld',
            'lastname.max:255' => 'Je hebt je achternaam niet ingevuld',

            'birthdate.sometimes' => 'Je hebt je geboortedatum niet ingevuld',


            
            //Both forms
            'township.required' => 'Je hebt je gemeente niet ingevuld',
            'township.string' => 'Je hebt je gemeente niet ingevuld',
            'township.max:255' => 'Je gemeente mag niet meer dan 255 karakters bevatten',

            'address.required' => 'Je hebt je adres niet ingevuld',
            'address.string' => 'Je hebt je adres niet ingevuld',
            'address.max:255' => 'Je adres mag niet meer dan 255 karakters bevatten',

            'phonenumber.required' => 'Je hebt je telefoonnummer niet ingevuld',

            'email.required' => 'Je hebt je email niet ingevuld',
            'email.string' => 'Je hebt je email niet ingevuld',
            'email.email' => 'Email adres ongeldig',
            'email.max:255' => 'Je email mag niet meer dan 255 karakters bevatten',
            'email.unique' => 'Er is al een account voor dit email adres',
            'email.confimed' => 'Je hebt je email niet bevestigd',
            
            'password.required' => 'Je hebt geen wachtwoord ingevuld',
            'password.confirmed' => 'Je hebt je wachtwoord niet bevestigd',
        ];
    }
}
