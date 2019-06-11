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
            //'sendreminder' => '',
            //'notify' => '',
        ];
    }
}
