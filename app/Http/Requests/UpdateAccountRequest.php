<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
             'township' => 'required|string|max:255',
             'address' => 'required|string|max:255',
             'phonenumber' => 'required',
             'email' => 'required|string|email|max:255',
             
             //Client form
             'firstname' => 'sometimes|string|max:255',
             'lastname' => 'sometimes|string|max:255',
             'birthdate' => 'sometimes|date',
 
 
             //Business form
             'name' => 'sometimes|string|max:255',
             'profession' => 'sometimes|string|max:255',
             'description' => 'sometimes|string',
             'appointmentduration' => 'sometimes',
             'allow_guests' => 'sometimes',
        ];
    }

    
    public function messages()
    {
        return [
            //Both forms
            'township.required' => 'Je hebt geen gemeente ingegeven',
            'township.string' => 'Je hebt geen gemeente ingegeven',
            'township.max:255' => 'Je gemeente mag niet meer dag 255 karakters bevatten',

            'address.required' => 'Je hebt geen adres ingegeven',
            'address.string' => 'Je hebt geen adres ingegeven',
            'address.max:255' => 'Je adres mag niet meer dag 255 karakters bevatten',

            'phonenumber.required' => 'Je hebt geen telefoonnummer ingegeven',

            'email.required' => 'Je hebt geen email ingegeven',
            'email.string' => 'Je hebt geen email ingegeven',
            'email.email' => 'Het ingegeven email is geen geldig email adres',
            'email.max:255' => 'Je email mag niet meer dag 255 karakters bevatten',


            
            //Client form
            'firstname.sometimes' => 'Je hebt geen voornaam ingegeven',
            'firstname.string' => 'Je hebt geen voornaam ingegeven',
            'firstname.max:255' => 'Je voornaam mag niet meer dag 255 karakters bevatten',

            'lastname.sometimes' => 'Je hebt geen achternaam ingegeven',
            'lastname.string' => 'Je hebt geen achternaam ingegeven',
            'lastname.max:255' => 'Je achternaam mag niet meer dag 255 karakters bevatten',

            'birthdate.sometimes' => 'Je hebt geen geboortedatum ingegeven',
            'birthdate.date' => 'De ingegeven geboortedatum is ongeldig',


            //Business form
            'name.sometimes' => 'Je hebt geen naam ingegeven',
            'name.string' => 'Je hebt geen naam ingegeven',
            'name.max:255' => 'Je naam mag niet meer dag 255 karakters bevatten',

            'profession.sometimes' => 'Je hebt geen beroep ingegeven',
            'profession.string' => 'Je hebt geen beroep ingegeven',
            'profession.max:255' => 'Je beroep mag niet meer dag 255 karakters bevatten',

            'description.sometimes' => 'Je hebt geen beschrijving ingegeven',
            'description.string' => 'Je hebt geen beschrijving ingegeven',

            'appointmentduration.sometimes' => 'Je hebt geen afspraaklengte ingegeven',

            'allow_guests.sometimes' => 'Je hebt niet ingegeven ofdat niet ingelogde gebruikers een afspraak mogen maken',
        ];
    }
}
