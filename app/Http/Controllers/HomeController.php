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

        //$openinghours = Business::with('user')->where('id', $id)->first();
        
        $appointments = Appointment::where('business_id', $id)->get();

        $mondayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'monday')->get();
        $tuesdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'tuesday')->get();
        $wednesdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'wednesday')->get();
        $thursdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'thursday')->get();
        $fridayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'friday')->get();
        $saturdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'saturday')->get();
        $sundayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'sunday')->get();


        return view('businesscalendar', compact(
            'appointments',
            'mondayhours',
            'tuesdayhours',
            'wednesdayhours',
            'thursdayhours',
            'fridayhours',
            'saturdayhours',
            'sundayhours'
        ));
    }
}
