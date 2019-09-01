<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;

use App\User;
use App\Business;
use App\OpeningHour;
use App\Appointment;
use App\Client;
use App\Http\Requests\CreateAppointmentRequest;
use App\Mail\AppointmentMail;
use App\Mail\EarlierAppointmentMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;

use Ical\Ical;

class AppointmentController extends Controller
{
    public function appointments(Request $request)
    {
        if ($request->session()->get('account_type') == 'klant') {
            $client_id = $request->session()->get('account_data')->id;

            $appointments = Appointment::with('business.user')->where('client_id', $client_id)->orderBy('date', 'asc')->orderBy('time_in_min', 'asc')->get();

        } elseif ($request->session()->get('account_type') == 'zaak') {
            $business_id = $request->session()->get('account_data')->id;

            $appointments = Appointment::with('client.user')->where('business_id', $business_id)->orderBy('date', 'asc')->orderBy('time_in_min', 'asc')->get();
        }

        return view('appointment.index', compact('appointments'));
    }



    public function removeappointment(Request $request)
    {
        $appointment_id = $request->appointment_id;

        $appointment = Appointment::where('id', $appointment_id)->first();
        
        if (Carbon::parse($appointment->date)->isFuture()) {
            $business = Business::where('id', $appointment->business_id)->first();

            $userAppointments = Appointment::with('client.user')->where('id', '!=', $appointment_id)->where('business_id', $appointment->business_id)->where('notify_if_earlier_appointment', true)->get();
            
            $businessName = $business->name;
            $appointmentDate = Carbon::parse($appointment->date)->format('d-m-Y');
            $appointmentTime = $appointment->time;

            $businessId = $appointment->business_id;
            $businessUrl = rawurlencode($businessName) . '-' . $businessId;
            
            foreach ($userAppointments as $userAppointment) {
                $email = $userAppointment->client->user->email;
                $clientName = $userAppointment->client->user->firstname . $userAppointment->client->user->lastname;
                
                try {
                    Mail::to($email)->send(new EarlierAppointmentMail($businessName, $appointmentDate, $appointmentTime, $businessUrl));
                }
                catch(\Exception $e) {
                    Log::error($e);
                }
            }
        }

        
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
        $existingAppointment = Appointment::where('date', $request->date)->where('time', $request->time)->where('time_in_min', $request->time_in_min)->first();
        
        $minuteTime = ((int)explode(':', $request->time)[0] * 60) + (int)explode(':', $request->time)[1];

        if (sizeof($existingAppointment) == 0 && $request->time_in_min == $minuteTime) {
                
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

                $mailEmail = $request->email;
            } else {
                $appointment->client_id = $request->session()->get('account_data')->id;

                $mailEmail = $request->session()->get('account_data')->user->email;
            }

            
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->time_in_min = $request->time_in_min;

            $appointment->details = $request->details;


            


            if ($request->notify) {
                $appointment->notify_if_earlier_appointment = true;
            } else {
                $appointment->notify_if_earlier_appointment = false;
            }


            $business = Business::with('user')->findOrFail($request->business_id);

            $businessName = $business->name;
            $date = date('d-m-Y', strtotime($request->time));
            $time = $request->time;

            $address = $business->user->address . ', ' . $business->user->township;
            $startdate = $request->date . ' ' . $request->time;
            $enddate = $request->date . ' ' .  date('H:i', strtotime('+' . $business->appointmentduration . ' minutes', strtotime($request->time)));
            $description = 'Afspraak bij ' . $business->name . ' (' . $address . ') op ' . $request->date . ' om ' . $request->time . 'u tot ' . date('H:i', strtotime('+' . $business->appointmentduration . ' minutes', strtotime($request->time))) . 'u';
            $summary = 'Afspraak ' . $business->name;
            
            try {
                Mail::to($mailEmail)->send(new AppointmentMail($address, $startdate, $enddate, $description, $summary, $businessName, $date, $time));
            }
            catch(\Exception $e) {
                Log::error($e);
            }

                
            $appointment->save();


            return redirect('/')->with('message', 'Afspraak aangemaakt');
        } else {
            return redirect('/')->with('error', 'Er ging iets fout');
        }
    }
}
