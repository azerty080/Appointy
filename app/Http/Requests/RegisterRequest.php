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
            //Both forms
            'township' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phonenumber' => 'required',
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|confirmed',

            
            //Client form
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'birthdate' => 'sometimes|date',


            //Business form
            'name' => 'sometimes|string|max:255',
            'profession' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'appointmentduration' => 'sometimes',



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
            //'time.required'         => 'Je hebt de puzzel niet opgelost',
        ];
    }
}
