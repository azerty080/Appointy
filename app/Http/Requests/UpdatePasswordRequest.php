<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ];
       }
   
       
       public function messages()
       {
           return [
               'oldpassword.required' => 'Je hebt je huidig wachtwoord niet ingevuld',
   
               'password.required' => 'Je hebt geen nieuw wachtwoord ingegeven',
               'password.confirmed' => 'Je hebt je nieuw wachtwoord niet bevestigd',
           ];
       }
}
