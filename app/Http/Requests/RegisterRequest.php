<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'birthdate' => 'sometimes|date',


            //Business form
            'name' => 'sometimes|string|max:255',
            'profession' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'appointmentduration' => 'sometimes|integer',
            'allow_guests' => 'sometimes',

                        
            //Both forms
            'township' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required',
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|confirmed',            


            //'is_monday_closed' => ,
            'monday_open_morning' => 'sometimes|before:monday_close_afternoon',
            'monday_close_morning' => 'sometimes|before:monday_open_afternoon|after:monday_open_morning',
            'monday_open_afternoon' => 'sometimes|before:monday_close_afternoon|after:monday_close_morning',
            'monday_close_afternoon' => 'sometimes|after:monday_open_morning',

            //'is_tuesday_closed' => ,
            'tuesday_open_morning' => 'sometimes|before:tuesday_close_afternoon',
            'tuesday_close_morning' => 'sometimes|before:tuesday_open_afternoon|after:tuesday_open_morning',
            'tuesday_open_afternoon' => 'sometimes|before:tuesday_close_afternoon|after:tuesday_close_morning',
            'tuesday_close_afternoon' => 'sometimes|after:tuesday_open_morning',

            //'is_wednesday_closed' => ,
            'wednesday_open_morning' => 'sometimes|before:wednesday_close_afternoon',
            'wednesday_close_morning' => 'sometimes|before:wednesday_open_afternoon|after:wednesday_open_morning',
            'wednesday_open_afternoon' => 'sometimes|before:wednesday_close_afternoon|after:wednesday_close_morning',
            'wednesday_close_afternoon' => 'sometimes|after:wednesday_open_morning',

            //'is_thursday_closed' => ,
            'thursday_open_morning' => 'sometimes|before:thursday_close_afternoon',
            'thursday_close_morning' => 'sometimes|before:thursday_open_afternoon|after:thursday_open_morning',
            'thursday_open_afternoon' => 'sometimes|before:thursday_close_afternoon|after:thursday_close_morning',
            'thursday_close_afternoon' => 'sometimes|after:thursday_open_morning',

            //'is_friday_closed' => ,
            'friday_open_morning' => 'sometimes|before:friday_close_afternoon',
            'friday_close_morning' => 'sometimes|before:friday_open_afternoon|after:friday_open_morning',
            'friday_open_afternoon' => 'sometimes|before:friday_close_afternoon|after:friday_close_morning',
            'friday_close_afternoon' => 'sometimes|after:friday_open_morning',

            //'is_saturday_closed' => ,
            'saturday_open_morning' => 'sometimes|before:saturday_close_afternoon',
            'saturday_close_morning' => 'sometimes|before:saturday_open_afternoon|after:saturday_open_morning',
            'saturday_open_afternoon' => 'sometimes|before:saturday_close_afternoon|after:saturday_close_morning',
            'saturday_close_afternoon' => 'sometimes|after:saturday_open_morning',

            //'is_sunday_closed' => ,
            'sunday_open_morning' => 'sometimes|before:sunday_close_afternoon',
            'sunday_close_morning' => 'sometimes|before:sunday_open_afternoon|after:sunday_open_morning',
            'sunday_open_afternoon' => 'sometimes|before:sunday_close_afternoon|after:sunday_close_morning',
            'sunday_close_afternoon' => 'sometimes|after:sunday_open_morning',
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
            'birthdate.date' => 'Je hebt je geboortedatum niet ingevuld',


            //Business form
            'name.sometimes' => 'Je hebt de naam van de zaak niet ingevuld',
            'name.string' => 'Je hebt de naam van de zaak niet ingevuld',
            'name.max:255' => 'Je hebt de naam van de zaak niet ingevuld',

            'profession.sometimes' => 'Je hebt je beroep niet ingevuld',
            'profession.string' => 'Je hebt je beroep niet ingevuld',
            'profession.max:255' => 'Je hebt je beroep niet ingevuld',

            'description.sometimes' => 'Je hebt je beschrijving niet ingevuld',
            'description.string' => 'Je hebt je beschrijving niet ingevuld',
            
            'appointmentduration.integer' => 'De lengte van een afspraak mag geen letters bevatten',
            


            
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




            // Monday
            'monday_open_morning.sometimes' => 'Je hebt het openingsuur van maandag niet ingevuld',
            'monday_open_morning.before:monday_close_afternoon' => 'Het openingsuur van maandag mag niet voor het sluitingsuur van maandag zijn',

            'monday_close_morning.sometimes' => 'Je hebt het sluitingsuur van maandag niet ingevuld',
            'monday_close_morning.before:monday_open_afternoon' => '',
            'monday_close_morning.after:monday_open_morning' => '',

            'monday_open_afternoon.sometimes' => 'Je hebt het openingsuur van maandag niet ingevuld',
            'monday_open_afternoon.before:monday_close_afternoon' => '',
            'monday_open_afternoon.after:monday_close_morning' => '',

            'monday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van maandag niet ingevuld',
            'monday_close_afternoon.after:monday_open_morning' => '',

            

            // Tuesday
            'tuesday_open_morning.sometimes' => 'Je hebt het openinsuur van dinsdag niet ingevuld',
            'tuesday_open_morning.before:tuesday_close_afternoon' => 'Het openingsuur van dinsdag mag niet voor het sluitingsuur van dinsdag zijn',

            'tuesday_close_morning.sometimes' => 'Je hebt het sluitingsuur van dinsdag niet ingevuld',
            'tuesday_close_morning.before:tuesday_open_afternoon' => '',
            'tuesday_close_morning.after:tuesday_open_morning' => '',

            'tuesday_open_afternoon.sometimes' => 'Je hebt het openinsuur van dinsdag niet ingevuld',
            'tuesday_open_afternoon.before:tuesday_close_afternoon' => '',
            'tuesday_open_afternoon.after:tuesday_close_morning' => '',

            'tuesday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van dinsdag niet ingevuld',
            'tuesday_close_afternoon.after:tuesday_open_morning' => '',

            

            // Wednesday
            'wednesday_open_morning.sometimes' => 'Je hebt het openingsuur van woensdag niet ingevuld',
            'wednesday_open_morning.before:wednesday_close_afternoon' => 'Het openingsuur van woensdag mag niet voor het sluitingsuur van woensdag zijn',

            'wednesday_close_morning.sometimes' => 'Je hebt het sluitingsuur van woensdag niet ingevuld',
            'wednesday_close_morning.before:wednesday_open_afternoon' => '',
            'wednesday_close_morning.after:wednesday_open_morning' => '',

            'wednesday_open_afternoon.sometimes' => 'Je hebt het openingsuur van woensdag niet ingevuld',
            'wednesday_open_afternoon.before:wednesday_close_afternoon' => '',
            'wednesday_open_afternoon.after:wednesday_close_morning' => '',

            'wednesday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van woensdag niet ingevuld',
            'wednesday_close_afternoon.after:wednesday_open_morning' => '',

            

            // Thursday
            'thursday_open_morning.sometimes' => 'Je hebt het openingsuur van donderdag niet ingevuld',
            'thursday_open_morning.before:thursday_close_afternoon' => 'Het openingsuur van donderdag mag niet voor het sluitingsuur van donderdag zijn',

            'thursday_close_morning.sometimes' => 'Je hebt het sluitingsuur van donderdag niet ingevuld',
            'thursday_close_morning.before:thursday_open_afternoon' => '',
            'thursday_close_morning.after:thursday_open_morning' => '',

            'thursday_open_afternoon.sometimes' => 'Je hebt het openingsuur van donderdag niet ingevuld',
            'thursday_open_afternoon.before:thursday_close_afternoon' => '',
            'thursday_open_afternoon.after:thursday_close_morning' => '',

            'thursday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van donderdag niet ingevuld',
            'thursday_close_afternoon.after:thursday_open_morning' => '',

            

            // Friday
            'friday_open_morning.sometimes' => 'Je hebt het openingsuur van vrijdag niet ingevuld',
            'friday_open_morning.before:friday_close_afternoon' => 'Het openingsuur van vrijdag mag niet voor het sluitingsuur van vrijdag zijn',

            'friday_close_morning.sometimes' => 'Je hebt het sluitingsuur van vrijdag niet ingevuld',
            'friday_close_morning.before:friday_open_afternoon' => '',
            'friday_close_morning.after:friday_open_morning' => '',

            'friday_open_afternoon.sometimes' => 'Je hebt het openingsuur van vrijdag niet ingevuld',
            'friday_open_afternoon.before:friday_close_afternoon' => '',
            'friday_open_afternoon.after:friday_close_morning' => '',

            'friday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van vrijdag niet ingevuld',
            'friday_close_afternoon.after:friday_open_morning' => '',

            


            // Saturday
            'saturday_open_morning.sometimes' => 'Je hebt het openingsuur van zaterdag niet ingevuld',
            'saturday_open_morning.before:saturday_close_afternoon' => 'Het openingsuur van zaterdag mag niet voor het sluitingsuur van zaterdag zijn',

            'saturday_close_morning.sometimes' => 'Je hebt het sluitingsuur van zaterdag niet ingevuld',
            'saturday_close_morning.before:saturday_open_afternoon' => '',
            'saturday_close_morning.after:saturday_open_morning' => '',

            'saturday_open_afternoon.sometimes' => 'Je hebt het openingsuur van zaterdag niet ingevuld',
            'saturday_open_afternoon.before:saturday_close_afternoon' => '',
            'saturday_open_afternoon.after:saturday_close_morning' => '',

            'saturday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van zaterdag niet ingevuld',
            'saturday_close_afternoon.after:saturday_open_morning' => '',

            


            // Sunday
            'sunday_open_morning.sometimes' => 'Je hebt het openingsuur van zondag niet ingevuld',
            'sunday_open_morning.before:sunday_close_afternoon' => 'Het openingsuur van zondag mag niet voor het sluitingsuur van zondag zijn',
            
            'sunday_close_morning.sometimes' => 'Je hebt het sluitingsuur van zondag niet ingevuld',
            'sunday_close_morning.before:sunday_open_afternoon' => '',
            'sunday_close_morning.after:sunday_open_morning' => '',

            'sunday_open_afternoon.sometimes' => 'Je hebt het openingsuur van zondag niet ingevuld',
            'sunday_open_afternoon.before:sunday_close_afternoon' => '',
            'sunday_open_afternoon.after:sunday_close_morning' => '',

            'sunday_close_afternoon.sometimes' => 'Je hebt het sluitingsuur van zondag niet ingevuld',
            'sunday_close_afternoon.after:sunday_open_morning' => '',
        ];
    }
}
