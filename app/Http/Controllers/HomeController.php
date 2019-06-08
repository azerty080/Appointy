<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Business;
use App\OpeningHour;
use App\Appointment;


use App\Http\Requests\SearchRequest;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }



    public function searchbusiness()
    {

    }



    public function searchresults(SearchRequest $request)
    {
        $name = $request->name;
        $profession = $request->profession;
        $township = $request->township;

        if ($name && $profession && $township) {

            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->where('profession', 'LIKE', '%'.$profession.'%')->where('township', 'LIKE', '%'.$township.'%')->get();

        } elseif ($name && $township) {

            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->where('township', 'LIKE', '%'.$township.'%')->get();

        } elseif ($profession && $township) {

            $businesses = Business::with('user')->where('profession', 'LIKE', '%'.$profession.'%')->where('township', 'LIKE', '%'.$township.'%')->get();

        } elseif ($name && $profession) {

            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->where('township', 'LIKE', '%'.$township.'%')->get();

        } elseif ($name) {

            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->get();

        } elseif ($profession) {

            $businesses = Business::with('user')->where('profession', 'LIKE', '%'.$profession.'%')->get();

        }
        
        //$users = User::with('business')->where('email', 'none')->get();

        return view('searchresults', compact('businesses'));
    }





    public function businessdetail(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $business = Business::with('user')->where('id', $id)->first();

        $mondayhours = OpeningHour::where('id', $id)->where('dayofweek', 'monday')->get();
        $tuesdayhours = OpeningHour::where('id', $id)->where('dayofweek', 'tuesday')->get();
        $wednesdayhours = OpeningHour::where('id', $id)->where('dayofweek', 'wednesday')->get();
        $thursdayhours = OpeningHour::where('id', $id)->where('dayofweek', 'thursday')->get();
        $fridayhours = OpeningHour::where('id', $id)->where('dayofweek', 'friday')->get();
        $saturdayhours = OpeningHour::where('id', $id)->where('dayofweek', 'saturday')->get();
        $sundayhours = OpeningHour::where('id', $id)->where('dayofweek', 'sunday')->get();
        
        return view('businessdetail', compact(
            'business',
            'mondayhours',
            'tuesdayhours',
            'wednesdayhours',
            'thursdayhours',
            'fridayhours',
            'saturdayhours',
            'sundayhours'
        ));
    }


    public function businesscalendar(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $addedweeks = $request->addedweeks;

        $businesshours = OpeningHour::where('business_id', $id)->where('closed', 0)->get();

        $appointmentduration = Business::where('id', $id)->pluck('appointmentduration')[0];
        
        $appointments = Appointment::where('business_id', $id)->get();

        $monday = OpeningHour::where('business_id', $id)->where('dayofweek', 'monday')->get();
        $tuesday = OpeningHour::where('business_id', $id)->where('dayofweek', 'tuesday')->get();
        $wednesday = OpeningHour::where('business_id', $id)->where('dayofweek', 'wednesday')->get();
        $thursday = OpeningHour::where('business_id', $id)->where('dayofweek', 'thursday')->get();
        $friday = OpeningHour::where('business_id', $id)->where('dayofweek', 'friday')->get();
        $saturday = OpeningHour::where('business_id', $id)->where('dayofweek', 'saturday')->get();
        $sunday = OpeningHour::where('business_id', $id)->where('dayofweek', 'sunday')->get();


        $earliesthour = 1440;
        $latesthour = 0;
        
        $earliesthourstr = '';
        $latesthourstr = '';


        foreach ($businesshours as $businesshour) {
            $openhour = ((int)explode(':', $businesshour->opentime)[0] * 60) + (int)explode(':', $businesshour->opentime)[1];
            $closehour = ((int)explode(':', $businesshour->closetime)[0] * 60) + (int)explode(':', $businesshour->closetime)[1];

            if ($openhour < $earliesthour) {
                $earliesthour = $openhour;
                $earliesthourstr = $businesshour->opentime;
            }

            if ($closehour > $latesthour) {
                $latesthour = $closehour;
                $latesthourstr = $businesshour->closetime;
            }
        }


        //print($earliesthourstr);
        //print($latesthourstr);


        return view('businesscalendar', compact(
            'id',
            'name',
            'addedweeks',
            
            'appointments',

            'appointmentduration',
            'earliesthour',
            'latesthour',

            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        ));
    }
}
