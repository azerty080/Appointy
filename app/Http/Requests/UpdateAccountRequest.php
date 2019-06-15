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
             'oldpassword' => 'required',
             'password' => 'sometimes|confirmed',
 
             
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
}
