<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Business;
use App\OpeningHour;

use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterClient;
use App\Http\Requests\RegisterBusiness;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }



    public function registerclient()
    {
        return view('auth.register-client');
    }



    public function registerbusiness()
    {
        return view('auth.register-business');
    }


    public function registerclientsubmit(RegisterClient $request)
    {
        // User
        $user = new User;

        $user->township = strtolower($request->township);
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->password = hash("sha256", $request->password);

        $user->save();


        // Client
        $client = new Client;

        $client->firstname = $request->firstname;
        $client->lastname = $request->lastname;
        $client->birthdate = $request->birthdate;
        $client->user_id = $user->id;

        $client->save();
        
        return redirect('/')->with('message', 'Account succesvol aangemaakt');
    }






        
    public function registerbusinesssubmit(RegisterBusiness $request)
    {
        // User
        $user = new User;

        $user->township = strtolower($request->township);
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->password = hash("sha256", $request->password);

        $user->save();


        // Business
        $business = new Business;

        $business->name = strtolower($request->name);
        $business->profession = strtolower($request->profession);
        $business->description = $request->description;
        $business->appointmentduration = $request->appointmentduration;
        $business->user_id = $user->id;

        if ($request['allow_guests']) {
            $business->allow_guests = true;
        } else {
            $business->allow_guests = false;
        }

        $business->save();


        // Monday
        if ($request['is_monday_closed']) {
            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'monday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'monday';

                $openinghour->opentime = $request->monday_open_morning;
                $openinghour->closetime = $request->monday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->monday_open_morning)[0] * 60) + (int)explode(':', $request->monday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->monday_close_afternoon)[0] * 60) + (int)explode(':', $request->monday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'monday';

                $openinghour->opentime = $request->monday_open_morning;
                $openinghour->closetime = $request->monday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->monday_open_morning)[0] * 60) + (int)explode(':', $request->monday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->monday_close_morning)[0] * 60) + (int)explode(':', $request->monday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'monday';

                $openinghour->opentime = $request->monday_open_afternoon;
                $openinghour->closetime = $request->monday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->monday_open_afternoon)[0] * 60) + (int)explode(':', $request->monday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->monday_close_afternoon)[0] * 60) + (int)explode(':', $request->monday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Tuesday
        if ($request['is_tuesday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'tuesday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'tuesday';

                $openinghour->opentime = $request->tuesday_open_morning;
                $openinghour->closetime = $request->tuesday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->tuesday_open_morning)[0] * 60) + (int)explode(':', $request->tuesday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->tuesday_close_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'tuesday';

                $openinghour->opentime = $request->tuesday_open_morning;
                $openinghour->closetime = $request->tuesday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->tuesday_open_morning)[0] * 60) + (int)explode(':', $request->tuesday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->tuesday_close_morning)[0] * 60) + (int)explode(':', $request->tuesday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'tuesday';

                $openinghour->opentime = $request->tuesday_open_afternoon;
                $openinghour->closetime = $request->tuesday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->tuesday_open_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->tuesday_close_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Wednesday
        if ($request['is_wednesday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'wednesday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'wednesday';

                $openinghour->opentime = $request->wednesday_open_morning;
                $openinghour->closetime = $request->wednesday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->wednesday_open_morning)[0] * 60) + (int)explode(':', $request->wednesday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->wednesday_close_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'wednesday';

                $openinghour->opentime = $request->wednesday_open_morning;
                $openinghour->closetime = $request->wednesday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->wednesday_open_morning)[0] * 60) + (int)explode(':', $request->wednesday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->wednesday_close_morning)[0] * 60) + (int)explode(':', $request->wednesday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'wednesday';

                $openinghour->opentime = $request->wednesday_open_afternoon;
                $openinghour->closetime = $request->wednesday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->wednesday_open_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->wednesday_close_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Thursday
        if ($request['is_thursday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'thursday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'thursday';

                $openinghour->opentime = $request->thursday_open_morning;
                $openinghour->closetime = $request->thursday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->thursday_open_morning)[0] * 60) + (int)explode(':', $request->thursday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->thursday_close_afternoon)[0] * 60) + (int)explode(':', $request->thursday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'thursday';

                $openinghour->opentime = $request->thursday_open_morning;
                $openinghour->closetime = $request->thursday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->thursday_open_morning)[0] * 60) + (int)explode(':', $request->thursday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->thursday_close_morning)[0] * 60) + (int)explode(':', $request->thursday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'thursday';

                $openinghour->opentime = $request->thursday_open_afternoon;
                $openinghour->closetime = $request->thursday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->thursday_open_afternoon)[0] * 60) + (int)explode(':', $request->thursday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->thursday_close_afternoon)[0] * 60) + (int)explode(':', $request->thursday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Friday
        if ($request['is_friday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'friday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'friday';

                $openinghour->opentime = $request->friday_open_morning;
                $openinghour->closetime = $request->friday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->friday_open_morning)[0] * 60) + (int)explode(':', $request->friday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->friday_close_afternoon)[0] * 60) + (int)explode(':', $request->friday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'friday';

                $openinghour->opentime = $request->friday_open_morning;
                $openinghour->closetime = $request->friday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->friday_open_morning)[0] * 60) + (int)explode(':', $request->friday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->friday_close_morning)[0] * 60) + (int)explode(':', $request->friday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'friday';

                $openinghour->opentime = $request->friday_open_afternoon;
                $openinghour->closetime = $request->friday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->friday_open_afternoon)[0] * 60) + (int)explode(':', $request->friday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->friday_close_afternoon)[0] * 60) + (int)explode(':', $request->friday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Saturday
        if ($request['is_saturday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'saturday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'saturday';

                $openinghour->opentime = $request->saturday_open_morning;
                $openinghour->closetime = $request->saturday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->saturday_open_morning)[0] * 60) + (int)explode(':', $request->saturday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->saturday_close_afternoon)[0] * 60) + (int)explode(':', $request->saturday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'saturday';

                $openinghour->opentime = $request->saturday_open_morning;
                $openinghour->closetime = $request->saturday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->saturday_open_morning)[0] * 60) + (int)explode(':', $request->saturday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->saturday_close_morning)[0] * 60) + (int)explode(':', $request->saturday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'saturday';

                $openinghour->opentime = $request->saturday_open_afternoon;
                $openinghour->closetime = $request->saturday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->saturday_open_afternoon)[0] * 60) + (int)explode(':', $request->saturday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->saturday_close_afternoon)[0] * 60) + (int)explode(':', $request->saturday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }


        // Sunday
        if ($request['is_sunday_closed']) {

            $openinghour = new OpeningHour;

            $openinghour->dayofweek = 'sunday';
            $openinghour->closed = true;
            $openinghour->business_id = $business->id;

            $openinghour->save();

        } else {
            if ($request['openingType'] == 'continuous') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'sunday';

                $openinghour->opentime = $request->sunday_open_morning;
                $openinghour->closetime = $request->sunday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->sunday_open_morning)[0] * 60) + (int)explode(':', $request->sunday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->sunday_close_afternoon)[0] * 60) + (int)explode(':', $request->sunday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            } elseif ($request['openingType'] == 'limited') {

                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'sunday';

                $openinghour->opentime = $request->sunday_open_morning;
                $openinghour->closetime = $request->sunday_close_morning;
                $openinghour->opentime_in_min = ((int)explode(':', $request->sunday_open_morning)[0] * 60) + (int)explode(':', $request->sunday_open_morning)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->sunday_close_morning)[0] * 60) + (int)explode(':', $request->sunday_close_morning)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();


                $openinghour = new OpeningHour;

                $openinghour->dayofweek = 'sunday';

                $openinghour->opentime = $request->sunday_open_afternoon;
                $openinghour->closetime = $request->sunday_close_afternoon;
                $openinghour->opentime_in_min = ((int)explode(':', $request->sunday_open_afternoon)[0] * 60) + (int)explode(':', $request->sunday_open_afternoon)[1];
                $openinghour->closetime_in_min = ((int)explode(':', $request->sunday_close_afternoon)[0] * 60) + (int)explode(':', $request->sunday_close_afternoon)[1];
                $openinghour->business_id = $business->id;

                $openinghour->save();

            }
        }
    
        
        return redirect('/')->with('message', 'Account succesvol aangemaakt');
    }
}
