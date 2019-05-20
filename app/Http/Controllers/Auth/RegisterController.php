<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            /*

            'firstname' => ['required', 'string', 'max:255'],

            'lastname' => ['required', 'string', 'max:255'],

            'birthdate' => [],

            'township' => ['required', 'string', 'max:255'],

            'address' => ['required', 'string', 'max:255'],

            'profilepicture' => [],

            'phonenumber' => [],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => [],

            'confirmpassword' => [],




            */

            /*

            'firstname' => ['required', 'string', 'max:255'],

            'lastname' => ['required', 'string', 'max:255'],


            'township' => ['required', 'string', 'max:255'],

            'address' => ['required', 'string', 'max:255'],
            
            'description' => ['required', 'string'],
            
            'extrainfo' => ['required', 'string'],




            'profilepicture' => [],

            'phonenumber' => [],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'confirmemail' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => [],

            'confirmpassword' => [],




            <button type="button" onclick="clickContinuous()" id="continuousBtn" class="selected">Doorlopende openingsuren</button>
            <button type="button" onclick="clickLimited()" id="limitedBtn" class="">Beperkte openingsuren</button>
            

            <input type="checkbox" name="is_monday_closed" value="is_monday_closed" onclick="clickIsClosed('monday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="monday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="monday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="monday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="monday_close_afternoon" type="time" value="18:00">




 'preferred_framework' => 'required_if_attribute:uses_framework,==,1'



            <input type="checkbox" name="is_tuesday_closed" value="is_tuesday_closed" onclick="clickIsClosed('tuesday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="tuesday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="tuesday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="tuesday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="tuesday_close_afternoon" type="time" value="18:00">



                
            <input type="checkbox" name="is_wednesday_closed" value="is_wednesday_closed" onclick="clickIsClosed('wednesday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="wednesday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="wednesday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="wednesday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="wednesday_close_afternoon" type="time" value="18:00">



                
            <input type="checkbox" name="is_thursday_closed" value="is_thursday_closed" onclick="clickIsClosed('thursday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="thursday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="thursday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="thursday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="thursday_close_afternoon" type="time" value="18:00">




            <input type="checkbox" name="is_friday_closed" value="is_friday_closed" onclick="clickIsClosed('friday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="friday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="friday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="friday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="friday_close_afternoon" type="time" value="18:00">





    
            <input type="checkbox" name="is_saturday_closed" value="is_saturday_closed" onclick="clickIsClosed('saturday')"> Vrije dag<br>

                <label>Openingsuur</label>
                <input name="saturday_open_morning" type="time" value="06:00">

                <label>Sluitingsuur</label>
                <input class="limitedInput" name="saturday_close_morning" type="time" value="12:00" disabled>

                <label>Openingsuur</label>
                <input class="limitedInput" name="saturday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="saturday_close_afternoon" type="time" value="18:00">
            



    
            <input type="checkbox" name="sunday" value="is_sunday_closed" onclick="clickIsClosed('sunday')"> Vrije dag<br>
            
                <label>Openingsuur</label>
                <input name="sunday_open_morning" type="time" value="06:00">
                
                <label>Sluitingsuur</label>
                <input class="limitedInput" name="sunday_close_morning" type="time" value="12:00" disabled>
                
                <label>Openingsuur</label>
                <input class="limitedInput" name="sunday_open_afternoon" type="time" value="13:00" disabled>

                <label>Sluitingsuur</label>
                <input name="sunday_close_afternoon" type="time" value="18:00">

            */
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
