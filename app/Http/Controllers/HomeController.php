<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Business;
use App\OpeningHour;
use App\Appointment;
use App\Bookmark;


use App\Http\Requests\SearchRequest;

use Carbon\Carbon;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function index()
    {
        // Mail::to('appointy@niels.vannimmen.mtantwerp.eu')->send(new TestMail());

        

        if (session()->get('account_type') == 'klant') {
            $client_id = session()->get('account_data')->id;

            $bookmarks = Bookmark::with('business.user')->where('client_id', $client_id)->take(10)->get();
        }

        return view('index', compact('bookmarks'));
    }



    public function searchresults(SearchRequest $request)
    {
        $name = $request->name;
        $profession = $request->profession;
        $township = $request->township;

        if ($name && $profession && $township) {
            $businesses = Business::with(['user' => function($q) use ($township) {
                $q->where('township', $township);
            }])->where('name', 'LIKE', '%'.$name.'%')->where('profession', 'LIKE', '%'.$profession.'%')->get();
        } elseif ($name && $township) {
            $businesses = Business::with(['user' => function($q) use ($township) {
                $q->where('township', $township);
            }])->where('name', 'LIKE', '%'.$name.'%')->get();
        } elseif ($profession && $township) {
            $businesses = Business::with(['user' => function($q) use ($township) {
                $q->where('township', $township);
            }])->where('profession', 'LIKE', '%'.$profession.'%')->get();
        } elseif ($name && $profession) {
            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->where('profession', 'LIKE', '%'.$profession.'%')->get();
        } elseif ($name) {
            $businesses = Business::with('user')->where('name', 'LIKE', '%'.$name.'%')->get();
        } elseif ($profession) {
            $businesses = Business::with('user')->where('profession', 'LIKE', '%'.$profession.'%')->get();
        }
        
        return view('searchresults', compact('businesses'));
    }





    public function businessdetail(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $isbookmarked = false;

        $business = Business::with('user')->where('id', $id)->first();

        $mondayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'monday')->get();
        $tuesdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'tuesday')->get();
        $wednesdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'wednesday')->get();
        $thursdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'thursday')->get();
        $fridayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'friday')->get();
        $saturdayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'saturday')->get();
        $sundayhours = OpeningHour::where('business_id', $id)->where('dayofweek', 'sunday')->get();
        
        
        if ($request->session()->has('logged_in')) {
            $client_id = $request->session()->get('account_data')->id;
            $bookmark = Bookmark::where('business_id', $id)->where('client_id', $client_id)->first();

            if (count($bookmark) > 0) {
                $isbookmarked = true;
            }
        }
        

        return view('businessdetail', compact(
            'business',
            'mondayhours',
            'tuesdayhours',
            'wednesdayhours',
            'thursdayhours',
            'fridayhours',
            'saturdayhours',
            'sundayhours',
            'isbookmarked'
        ));
    }


    public function businesscalendar(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $addedweeks = $request->addedweeks;

        $businesshours = OpeningHour::where('business_id', $id)->where('closed', 0)->get();

        $appointmentduration = Business::where('id', $id)->first()->appointmentduration;
        
//$appointments = Appointment::where('business_id', $id)->get();

/*
        $startofweek = Carbon::now()->addWeek($addedweeks)->startOfWeek()->format('Y-m-d');
        $endofweek = Carbon::now()->addWeek($addedweeks)->endOfWeek()->format('Y-m-d');

        $appointments = Appointment::where('business_id', $id)->where('date', '>=', $startofweek)->where('date', '<=', $endofweek)->get();
*/

        $mondaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek();
        $tuesdaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(1);
        $wednesdaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(2);
        $thursdaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(3);
        $fridaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(4);
        $saturdaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(5);
        $sundaydate = Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(6);

        $mondayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $mondaydate)->get();
        $mondayhours = [];
        foreach($mondayappointments as $mondayappointment) {
            array_push($mondayhours, $mondayappointment->time);
        }

        $tuesdayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $tuesdaydate)->get();
        $tuesdayhours = [];
        foreach($tuesdayappointments as $tuesdayappointment) {
            array_push($tuesdayhours, $tuesdayappointment->time_in_min);
        }

        $wednesdayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $wednesdaydate)->get();
        $wednesdayhours = [];
        foreach($wednesdayappointments as $wednesdayappointment) {
            array_push($wednesdayhours, $wednesdayappointment->time_in_min);
        }

        $thursdayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $thursdaydate)->get();
        $thursdayhours = [];
        foreach($thursdayappointments as $thursdayappointment) {
            array_push($thursdayhours, $thursdayappointment->time_in_min);
        }

        $fridayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $fridaydate)->get();
        $fridayhours = [];
        foreach($fridayappointments as $fridayappointment) {
            array_push($fridayhours, $fridayappointment->time_in_min);
        }

        $saturdayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $saturdaydate)->get();
        $saturdayhours = [];
        foreach($saturdayappointments as $saturdayappointment) {
            array_push($saturdayhours, $saturdayappointment->time_in_min);
        }

        $sundayappointments = Appointment::select('time_in_min')->where('business_id', $id)->where('date', $sundaydate)->get();
        $sundayhours = [];
        foreach($sundayappointments as $sundayappointment) {
            array_push($sundayhours, $sundayappointment->time_in_min);
        }


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

        return view('businesscalendar', compact(
            'id',
            'name',
            'addedweeks',
            
            'mondayhours',
            'tuesdayhours',
            'wednesdayhours',
            'thursdayhours',
            'fridayhours',
            'saturdayhours',
            'sundayhours',

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
