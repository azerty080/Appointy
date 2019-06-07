<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Business;
use App\OpeningHour;

use App\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }



    public function registersubmit(RegisterRequest $request)
    {
        $user = new User;

        $user->township = $request->township;
        $user->address = $request->address;
        $user->phonenumber = $request->phonenumber;
        $user->email = $request->email;
        $user->password = hash("sha256", $request->password);

        $user->save();


        if ($request['formType'] == 'client') {
            $client = new Client;

            $client->firstname = $request->firstname;
            $client->lastname = $request->lastname;
            $client->birthdate = $request->birthdate;
            $client->user_id = $user->id;

            $client->save();
        }
        elseif ($request['formType'] == 'business') {
            $business = new Business;

            $business->name = $request->name;
            $business->profession = $request->profession;
            $business->description = $request->description;
            $business->user_id = $user->id;

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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'monday';

                    $openinghour->opentime = $request->monday_open_morning;
                    $openinghour->closetime = $request->monday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'monday';

                    $openinghour->opentime = $request->monday_open_afternoon;
                    $openinghour->closetime = $request->monday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'tuesday';

                    $openinghour->opentime = $request->tuesday_open_morning;
                    $openinghour->closetime = $request->tuesday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'tuesday';

                    $openinghour->opentime = $request->tuesday_open_afternoon;
                    $openinghour->closetime = $request->tuesday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'wednesday';

                    $openinghour->opentime = $request->wednesday_open_morning;
                    $openinghour->closetime = $request->wednesday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'wednesday';

                    $openinghour->opentime = $request->wednesday_open_afternoon;
                    $openinghour->closetime = $request->wednesday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'thursday';

                    $openinghour->opentime = $request->thursday_open_morning;
                    $openinghour->closetime = $request->thursday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'thursday';

                    $openinghour->opentime = $request->thursday_open_afternoon;
                    $openinghour->closetime = $request->thursday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'friday';

                    $openinghour->opentime = $request->friday_open_morning;
                    $openinghour->closetime = $request->friday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'friday';

                    $openinghour->opentime = $request->friday_open_afternoon;
                    $openinghour->closetime = $request->friday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'saturday';

                    $openinghour->opentime = $request->saturday_open_morning;
                    $openinghour->closetime = $request->saturday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'saturday';

                    $openinghour->opentime = $request->saturday_open_afternoon;
                    $openinghour->closetime = $request->saturday_close_afternoon;
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
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                } elseif ($request['openingType'] == 'limited') {

                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'sunday';

                    $openinghour->opentime = $request->sunday_open_morning;
                    $openinghour->closetime = $request->sunday_close_morning;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();


                    $openinghour = new OpeningHour;

                    $openinghour->dayofweek = 'sunday';

                    $openinghour->opentime = $request->sunday_open_afternoon;
                    $openinghour->closetime = $request->sunday_close_afternoon;
                    $openinghour->business_id = $business->id;

                    $openinghour->save();

                }
            }
        }
        
        return redirect('/');
    }
}
