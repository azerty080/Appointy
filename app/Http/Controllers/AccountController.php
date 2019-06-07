<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Client;
use App\Business;
use App\OpeningHour;

class AccountController extends Controller
{
    public function account()
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('user_type');
            $id = session()->get('user_id');

            $userdata = User::where('id', $id)->first();
            
            if ($usertype == 'klant') {
                
                $extradata = Client::where('user_id', $id)->first();

                
                return view('account.index', compact('userdata', 'extradata'));

            } elseif ($usertype == 'zaak') {
                
                $extradata = Business::where('user_id', $id)->first();

                //$businesshours = OpeningHour::where('business_id', $extradata->id)->get();

                $mondayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'monday')->get();
                $tuesdayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'tuesday')->get();
                $wednesdayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'wednesday')->get();
                $thursdayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'thursday')->get();
                $fridayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'friday')->get();
                $saturdayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'saturday')->get();
                $sundayhours = OpeningHour::where('business_id', $extradata->id)->where('dayofweek', 'sunday')->get();

                return view('account.index', compact(
                    'userdata',
                    'extradata',
                    'mondayhours',
                    'tuesdayhours',
                    'wednesdayhours',
                    'thursdayhours',
                    'fridayhours',
                    'saturdayhours',
                    'sundayhours'
                ));

            } else {
                return redirect('/')->with('message', 'Er ging iets fout');
            }
        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }
}
