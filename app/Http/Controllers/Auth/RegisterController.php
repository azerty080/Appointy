<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Business;

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
        $ifClientForm = 'required_if:formType,client';
        $ifBusinessForm = 'required_if:formType,business';

        $ifContinuousOpen = 'required_if:openingType,continuous';
        $ifLimitedOpen = 'required_if:openingType,limited';




        $ifMondayClosed = 'required_if:monday_closed,on';
        $ifTuesdayClosed = 'required_if:tuesday_closed,on';
        $ifWednesdayClosed = 'required_if:wednesday_closed,on';
        $ifThursdayClosed = 'required_if:thursday_closed,on';
        $ifFridayClosed = 'required_if:friday_closed,on';
        $ifSaturdayClosed = 'required_if:saturday_closed,on';
        $ifSundayClosed = 'required_if:sunday_closed,on';








        return Validator::make($data, [
            /*
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            */
            
            
            //Both forms

            'township' => ['required', 'string', 'max:255'],

            'address' => ['required', 'string', 'max:255'],

            'profilepicture' => ['required', ],

            'phonenumber' => ['required', ],


            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],

            //'confirmemail' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => ['required', 'confirmed'],

            // 'confirmpassword' => ['required', ],


                        

            
            //Client form

            'firstname' => [$ifClientForm, 'string', 'max:255'],

            'lastname' => [$ifClientForm, 'string', 'max:255'],

            'birthdate' => [$ifClientForm, ],






            //Business form

            'name' => [$ifBusinessForm, 'string', 'max:255'],

            'description' => [$ifBusinessForm, 'string'],

            'extrainfo' => [$ifBusinessForm, 'string'],









            'is_monday_closed' => [],

            'monday_open_morning' => [$ifBusinessForm, ],

            'monday_close_morning' => [$ifMondayClosed, ],

            'monday_open_afternoon' => [$ifMondayClosed, ],

            'monday_close_afternoon' => [$ifBusinessForm, ],





            'is_tuesday_closed' => [],

            'tuesday_open_morning' => [$ifBusinessForm, ],

            'tuesday_close_morning' => [$ifTuesdayClosed, ],

            'tuesday_open_afternoon' => [$ifTuesdayClosed, ],

            'tuesday_close_afternoon' => [$ifBusinessForm, ],



            'is_wednesday_closed' => [],

            'wednesday_open_morning' => [$ifBusinessForm, ],

            'wednesday_close_morning' => [$ifWednesdayClosed, ],

            'wednesday_open_afternoon' => [$ifWednesdayClosed, ],

            'wednesday_close_afternoon' => [$ifBusinessForm, ],




            'is_thursday_closed' => [],

            'thursday_open_morning' => [$ifBusinessForm, ],

            'thursday_close_morning' => [$ifThursdayClosed, ],

            'thursday_open_afternoon' => [$ifThursdayClosed, ],

            'thursday_close_afternoon' => [$ifBusinessForm, ],




            'is_friday_closed' => [],

            'friday_open_morning' => [$ifBusinessForm, ],

            'friday_close_morning' => [$ifFridayClosed, ],

            'friday_open_afternoon' => [$ifFridayClosed, ],

            'friday_close_afternoon' => [$ifBusinessForm, ],






            'is_saturday_closed' => [],

            'saturday_open_morning' => [$ifBusinessForm, ],

            'saturday_close_morning' => [$ifSaturdayClosed, ],

            'saturday_open_afternoon' => [$ifSaturdayClosed, ],

            'saturday_close_afternoon' => [$ifBusinessForm, ],





            'is_sunday_closed' => [],

            'sunday_open_morning' => [$ifBusinessForm, ],

            'sunday_close_morning' => [$ifSundayClosed, ],

            'sunday_open_afternoon' => [$ifSundayClosed, ],

            'sunday_close_afternoon' => [$ifBusinessForm, ],
        
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
        //var_dump($data['formType']);
        if ($data['formType'] == 'client') {
            Client::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'birthdate' => $data['birthdate'],
                
                'township' => $data['township'],
                'address' => $data['address'],
                'phonenumber' => $data['phonenumber'],

                'profilepicture' => $data['profilepicture'], // ????

                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
        elseif ($data['formType'] == 'business') {


            Business::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
       

        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
