<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Business;
use App\OpeningHour;
use App\Appointment;

use App\Http\Requests\CreateAppointmentRequest;

class AppointmentController extends Controller
{
    public function appointments(Request $request)
    {
        if ($request->session()->get('user_type') == 'klant') {
            $client_id = $request->session()->get('user_data')->id;

            $appointments = Appointment::with('business.user')->where('client_id', $client_id)->orderBy('date', 'asc')->orderBy('time_in_min', 'asc')->get();

        } elseif ($request->session()->get('user_type') == 'zaak') {
            $business_id = $request->session()->get('user_data')->id;

            $appointments = Appointment::with('client.user')->where('business_id', $business_id)->orderBy('date', 'asc')->orderBy('time_in_min', 'asc')->get();
        }

        return view('appointment.index', compact('appointments'));
    }



    public function removeappointment(Request $request)
    {
        $appointment_id = $request->appointment_id;

        $appointment = Appointment::where('id', $appointment_id);

        $appointment->delete();

        return redirect(route('appointments'));
    }




    public function appointmentform(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $day = $request->day;
        $time = $request->time;

        return view('appointment.form', compact('id', 'name', 'day', 'time'));
    }



    public function createappointment(CreateAppointmentRequest $request)
    {
        $appointment = new Appointment;

        $appointment->business_id = $request->business_id;

        if (!$request->session()->has('logged_in')) {
            $appointment->firstname = $request->firstname;
            $appointment->lastname = $request->lastname;
            $appointment->birthdate = $request->birthdate;
            $appointment->township = $request->township;
            $appointment->address = $request->address;
            $appointment->phonenumber = $request->phonenumber;
            $appointment->email = $request->email;
        } else {
            $appointment->client_id = $request->session()->get('user_data')->id;
        }

        
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->time_in_min = $request->time_in_min;

        $appointment->details = $request->details;

        
        if ($request->sendreminder) {
            $appointment->sendreminder = true;
        } else {
            $appointment->sendreminder = false;
        }


        if ($request->notify) {
            $appointment->notify_if_earlier_appointment = true;
        } else {
            $appointment->notify_if_earlier_appointment = false;
        }
        

        $appointment->save();


        return redirect('/')->with('message', 'Afspraak aangemaakt');
    }
}
