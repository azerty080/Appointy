<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
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
            'firstname' => 'sometimes|string',
            'lastname' => 'sometimes|string',
            'birthdate' => 'sometimes|date',
            'township' => 'sometimes|string',
            'address' => 'sometimes|string',
            'phonenumber' => 'sometimes',
            'email' => 'sometimes|email',


            'details' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'time_in_min' => 'required',
        ];
    }



    
    public function messages()
    {
        return [
            'firstname.sometimes' => 'Je hebt je voornaam niet ingevuld',
            'firstname.string' => 'Je hebt je voornaam niet ingevuld',

            'lastname.sometimes' => 'Je hebt je achternaam niet ingevuld',
            'lastname.string' => 'Je hebt je achternaam niet ingevuld',

            'birthdate.sometimes' => 'Je hebt je geboortedatum niet ingevuld',
            'birthdate.date' => 'Je hebt je geboortedatum niet ingevuld',

            'township.sometimes' => 'Je hebt je gemeente niet ingevuld',
            'township.string' => 'Je hebt je gemeente niet ingevuld',

            'address.sometimes' => 'Je hebt je adres niet ingevuld',
            'address.string' => 'Je hebt je adres niet ingevuld',

            'phonenumber.sometimes' => 'Je hebt je telefoonnummer niet ingevuld',

            'email.sometimes' => 'Je hebt je email niet ingevuld',
            'email.email' => 'Dit email adres is ongeldig',


            'details.required' => 'Er ging iets mis, probeer nogmaals',

            'date.required' => 'Er ging iets mis, probeer nogmaals',
            'date.date' => 'Er ging iets mis, probeer nogmaals',

            'time.required' => 'Er ging iets mis, probeer nogmaals',

            'time_in_min.required' => 'Er ging iets mis, probeer nogmaals',
        ];
    }
}
