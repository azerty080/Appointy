<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Client;
use App\Business;
use App\OpeningHour;

use App\Http\Requests\UpdateAccountRequest;
use App\Http\Requests\UpdateOpeningHoursRequest;

class AccountController extends Controller
{
    public function account()
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;

            if ($usertype == 'klant') {
                
                $userdata = Client::with('user')->where('id', $id)->first();
                
                return view('account.index', compact('userdata'));

            } elseif ($usertype == 'zaak') {
                
                $userdata = Business::with('user')->where('id', $id)->first();

                $mondayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'monday')->get();
                $tuesdayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'tuesday')->get();
                $wednesdayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'wednesday')->get();
                $thursdayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'thursday')->get();
                $fridayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'friday')->get();
                $saturdayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'saturday')->get();
                $sundayhours = OpeningHour::where('business_id', $userdata->id)->where('dayofweek', 'sunday')->get();

                return view('account.index', compact(
                    'userdata',
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




    public function editaccount()
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;

            if ($usertype == 'klant') {
                
                $accountdata = Client::with('user')->where('id', $id)->first();

            } elseif ($usertype == 'zaak') {
                
                $accountdata = Business::with('user')->where('id', $id)->first();

            } else {
                return redirect('/')->with('message', 'Er ging iets fout');
            }
            
            return view('account.edit', compact('accountdata'));

        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }



    
    public function editopeninghours()
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;

            if ($usertype == 'zaak') {
                
                $accountdata = Business::with('user')->where('id', $id)->first();

                $mondayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'monday')->orderBy('opentime_in_min', 'asc')->get();
                $tuesdayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'tuesday')->orderBy('opentime_in_min', 'asc')->get();
                $wednesdayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'wednesday')->orderBy('opentime_in_min', 'asc')->get();
                $thursdayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'thursday')->orderBy('opentime_in_min', 'asc')->get();
                $fridayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'friday')->orderBy('opentime_in_min', 'asc')->get();
                $saturdayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'saturday')->orderBy('opentime_in_min', 'asc')->get();
                $sundayhours = OpeningHour::where('business_id', $accountdata->id)->where('dayofweek', 'sunday')->orderBy('opentime_in_min', 'asc')->get();

                $openingType = 'continuous';
                
                $openingCount = count($mondayhours) + count($tuesdayhours) + count($wednesdayhours) + count($thursdayhours) + count($fridayhours) + count($saturdayhours) + count($sundayhours);

                if ($openingCount > 7) {
                    $openingType = 'limited';
                }


                return view('account.editopeninghours', compact(
                    'accountdata',
                    'mondayhours',
                    'tuesdayhours',
                    'wednesdayhours',
                    'thursdayhours',
                    'fridayhours',
                    'saturdayhours',
                    'sundayhours',
                    'openingType'
                ));

            } else {
                return redirect('/')->with('message', 'Je moet ingelogd zijn als zaak om je openingsuren aan te passen');
            }
        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }


    
    public function updateaccount(UpdateAccountRequest $request)
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;
            $user_id = session()->get('account_data')->user_id;

            $user = User::where('id', $user_id)->first();
            $checkNewEmail = User::where('id', "!=", $user_id)->where('email', $request->email)->get();
            
            if (count($checkNewEmail) == 0 && hash("sha256", $request->oldpassword) == $user->password) {
                User::where('id', $user_id)->update([
                    'township' => $request->township,
                    'address' => $request->address,
                    'phonenumber' => $request->phonenumber,
                    'email' => $request->email,
                    'password' => hash("sha256", $request->password),
                ]);
            }
            
            if ($usertype == 'klant') {
                
                Client::where('id', $id)->update([
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'birthdate' => $request->birthdate,
                ]);

                $userdata = Client::with('user')->where('user_id', $user_id)->first();

            } elseif ($usertype == 'zaak') {
   
                $allow_guests = false;

                if ($request->allow_guests) {
                    $allow_guests = true;
                } else {
                    $allow_guests = false;
                }

                Business::where('id', $id)->update([
                    'name' => $request->name,
                    'profession' => $request->profession,
                    'description' => $request->description,
                    'appointmentduration' => $request->appointmentduration,
                    'allow_guests' => $allow_guests,
                ]);
                
                $userdata = Business::with('user')->where('user_id', $user_id)->first();

            } else {
                return redirect('/')->with('message', 'Er ging iets fout');
            }

            session(['account_data' => $userdata]);

            return redirect(route('account'));
        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }



    
    public function updateopeninghours(UpdateOpeningHoursRequest $request)
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;
 
            if ($usertype == 'zaak') {
              
                // Monday
                if ($request->is_monday_closed) {

                    OpeningHour::where('id', $request->monday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->monday_id_2) {
                        OpeningHour::where('id', $request->monday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->monday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->monday_open_morning,
                            'closetime' => $request->monday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->monday_open_morning)[0] * 60) + (int)explode(':', $request->monday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->monday_close_afternoon)[0] * 60) + (int)explode(':', $request->monday_close_afternoon)[1],
                        ]);

                        
                        if ($request->monday_id_2) {
                            OpeningHour::where('id', $request->monday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->monday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->monday_open_morning,
                            'closetime' => $request->monday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->monday_open_morning)[0] * 60) + (int)explode(':', $request->monday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->monday_close_morning)[0] * 60) + (int)explode(':', $request->monday_close_morning)[1],
                        ]);
                        
                        if (isset($request->monday_id_2)) {
                            OpeningHour::where('id', $request->monday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->monday_open_afternoon,
                                'closetime' => $request->monday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->monday_open_afternoon)[0] * 60) + (int)explode(':', $request->monday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->monday_close_afternoon)[0] * 60) + (int)explode(':', $request->monday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'monday';
        
                            $openinghour->opentime = $request->monday_open_afternoon;
                            $openinghour->closetime = $request->monday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->monday_open_afternoon)[0] * 60) + (int)explode(':', $request->monday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->monday_close_afternoon)[0] * 60) + (int)explode(':', $request->monday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                        
                    }
                }


                // Tuesday
                if ($request->is_tuesday_closed) {

                    OpeningHour::where('id', $request->tuesday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->tuesday_id_2) {
                        OpeningHour::where('id', $request->tuesday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->tuesday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->tuesday_open_morning,
                            'closetime' => $request->tuesday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->tuesday_open_morning)[0] * 60) + (int)explode(':', $request->tuesday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->tuesday_close_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_close_afternoon)[1],
                        ]);

                        if ($request->tuesday_id_2) {
                            OpeningHour::where('id', $request->tuesday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->tuesday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->tuesday_open_morning,
                            'closetime' => $request->tuesday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->tuesday_open_morning)[0] * 60) + (int)explode(':', $request->tuesday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->tuesday_close_morning)[0] * 60) + (int)explode(':', $request->tuesday_close_morning)[1],
                        ]);
                        
                        if (isset($request->tuesday_id_2)) {
                            OpeningHour::where('id', $request->tuesday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->tuesday_open_afternoon,
                                'closetime' => $request->tuesday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->tuesday_open_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->tuesday_close_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'tuesday';
        
                            $openinghour->opentime = $request->tuesday_open_afternoon;
                            $openinghour->closetime = $request->tuesday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->tuesday_open_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->tuesday_close_afternoon)[0] * 60) + (int)explode(':', $request->tuesday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }


                // Wednesday
                if ($request->is_wednesday_closed) {

                    OpeningHour::where('id', $request->wednesday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->wednesday_id_2) {
                        OpeningHour::where('id', $request->wednesday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->wednesday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->wednesday_open_morning,
                            'closetime' => $request->wednesday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->wednesday_open_morning)[0] * 60) + (int)explode(':', $request->wednesday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->wednesday_close_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_close_afternoon)[1],
                        ]);

                        if ($request->wednesday_id_2) {
                            OpeningHour::where('id', $request->wednesday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->wednesday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->wednesday_open_morning,
                            'closetime' => $request->wednesday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->wednesday_open_morning)[0] * 60) + (int)explode(':', $request->wednesday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->wednesday_close_morning)[0] * 60) + (int)explode(':', $request->wednesday_close_morning)[1],
                        ]);
                        
                        if (isset($request->wednesday_id_2)) {
                            OpeningHour::where('id', $request->wednesday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->wednesday_open_afternoon,
                                'closetime' => $request->wednesday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->wednesday_open_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->wednesday_close_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'wednesday';
        
                            $openinghour->opentime = $request->wednesday_open_afternoon;
                            $openinghour->closetime = $request->wednesday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->wednesday_open_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->wednesday_close_afternoon)[0] * 60) + (int)explode(':', $request->wednesday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }



                // Thursday
                if ($request->is_thursday_closed) {

                    OpeningHour::where('id', $request->thursday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->thursday_id_2) {
                        OpeningHour::where('id', $request->thursday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->thursday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->thursday_open_morning,
                            'closetime' => $request->thursday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->thursday_open_morning)[0] * 60) + (int)explode(':', $request->thursday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->thursday_close_afternoon)[0] * 60) + (int)explode(':', $request->thursday_close_afternoon)[1],
                        ]);

                        if ($request->thursday_id_2) {
                            OpeningHour::where('id', $request->thursday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->thursday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->thursday_open_morning,
                            'closetime' => $request->thursday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->thursday_open_morning)[0] * 60) + (int)explode(':', $request->thursday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->thursday_close_morning)[0] * 60) + (int)explode(':', $request->thursday_close_morning)[1],
                        ]);
                        
                        if (isset($request->thursday_id_2)) {
                            OpeningHour::where('id', $request->thursday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->thursday_open_afternoon,
                                'closetime' => $request->thursday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->thursday_open_afternoon)[0] * 60) + (int)explode(':', $request->thursday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->thursday_close_afternoon)[0] * 60) + (int)explode(':', $request->thursday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'thursday';
        
                            $openinghour->opentime = $request->thursday_open_afternoon;
                            $openinghour->closetime = $request->thursday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->thursday_open_afternoon)[0] * 60) + (int)explode(':', $request->thursday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->thursday_close_afternoon)[0] * 60) + (int)explode(':', $request->thursday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }


                // Friday
                if ($request->is_friday_closed) {

                    OpeningHour::where('id', $request->friday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->friday_id_2) {
                        OpeningHour::where('id', $request->friday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->friday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->friday_open_morning,
                            'closetime' => $request->friday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->friday_open_morning)[0] * 60) + (int)explode(':', $request->friday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->friday_close_afternoon)[0] * 60) + (int)explode(':', $request->friday_close_afternoon)[1],
                        ]);

                        if ($request->friday_id_2) {
                            OpeningHour::where('id', $request->friday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->friday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->friday_open_morning,
                            'closetime' => $request->friday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->friday_open_morning)[0] * 60) + (int)explode(':', $request->friday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->friday_close_morning)[0] * 60) + (int)explode(':', $request->friday_close_morning)[1],
                        ]);
                        
                        if (isset($request->friday_id_2)) {
                            OpeningHour::where('id', $request->friday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->friday_open_afternoon,
                                'closetime' => $request->friday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->friday_open_afternoon)[0] * 60) + (int)explode(':', $request->friday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->friday_close_afternoon)[0] * 60) + (int)explode(':', $request->friday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'friday';
        
                            $openinghour->opentime = $request->friday_open_afternoon;
                            $openinghour->closetime = $request->friday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->friday_open_afternoon)[0] * 60) + (int)explode(':', $request->friday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->friday_close_afternoon)[0] * 60) + (int)explode(':', $request->friday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }


                // Saturday
                if ($request->is_saturday_closed) {

                    OpeningHour::where('id', $request->saturday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->saturday_id_2) {
                        OpeningHour::where('id', $request->saturday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->saturday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->saturday_open_morning,
                            'closetime' => $request->saturday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->saturday_open_morning)[0] * 60) + (int)explode(':', $request->saturday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->saturday_close_afternoon)[0] * 60) + (int)explode(':', $request->saturday_close_afternoon)[1],
                        ]);

                        if ($request->saturday_id_2) {
                            OpeningHour::where('id', $request->saturday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->saturday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->saturday_open_morning,
                            'closetime' => $request->saturday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->saturday_open_morning)[0] * 60) + (int)explode(':', $request->saturday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->saturday_close_morning)[0] * 60) + (int)explode(':', $request->saturday_close_morning)[1],
                        ]);
                        
                        if (isset($request->saturday_id_2)) {
                            OpeningHour::where('id', $request->saturday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->saturday_open_afternoon,
                                'closetime' => $request->saturday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->saturday_open_afternoon)[0] * 60) + (int)explode(':', $request->saturday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->saturday_close_afternoon)[0] * 60) + (int)explode(':', $request->saturday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'saturday';
        
                            $openinghour->opentime = $request->saturday_open_afternoon;
                            $openinghour->closetime = $request->saturday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->saturday_open_afternoon)[0] * 60) + (int)explode(':', $request->saturday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->saturday_close_afternoon)[0] * 60) + (int)explode(':', $request->saturday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }


                // Sunday
                if ($request->is_sunday_closed) {

                    OpeningHour::where('id', $request->sunday_id_1)->update([
                        'closed' => true,
                    ]);

                    if ($request->sunday_id_2) {
                        OpeningHour::where('id', $request->sunday_id_2)->update([
                            'closed' => true,
                        ]);
                    }

                } else {
                    if ($request->openingType == 'continuous') {

                        OpeningHour::where('id', $request->sunday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->sunday_open_morning,
                            'closetime' => $request->sunday_close_afternoon,
                            'opentime_in_min' => ((int)explode(':', $request->sunday_open_morning)[0] * 60) + (int)explode(':', $request->sunday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->sunday_close_afternoon)[0] * 60) + (int)explode(':', $request->sunday_close_afternoon)[1],
                        ]);

                        if ($request->sunday_id_2) {
                            OpeningHour::where('id', $request->sunday_id_2)->delete();
                        }

                    } elseif ($request->openingType == 'limited') {

                        OpeningHour::where('id', $request->sunday_id_1)->update([
                            'closed' => false,
                            'opentime' => $request->sunday_open_morning,
                            'closetime' => $request->sunday_close_morning,
                            'opentime_in_min' => ((int)explode(':', $request->sunday_open_morning)[0] * 60) + (int)explode(':', $request->sunday_open_morning)[1],
                            'closetime_in_min' => ((int)explode(':', $request->sunday_close_morning)[0] * 60) + (int)explode(':', $request->sunday_close_morning)[1],
                        ]);
                        
                        if (isset($request->sunday_id_2)) {
                            OpeningHour::where('id', $request->sunday_id_2)->update([
                                'closed' => false,
                                'opentime' => $request->sunday_open_afternoon,
                                'closetime' => $request->sunday_close_afternoon,
                                'opentime_in_min' => ((int)explode(':', $request->sunday_open_afternoon)[0] * 60) + (int)explode(':', $request->sunday_open_afternoon)[1],
                                'closetime_in_min' => ((int)explode(':', $request->sunday_close_afternoon)[0] * 60) + (int)explode(':', $request->sunday_close_afternoon)[1],
                            ]);
                        } else {
                            $openinghour = new OpeningHour;

                            $openinghour->dayofweek = 'sunday';
        
                            $openinghour->opentime = $request->sunday_open_afternoon;
                            $openinghour->closetime = $request->sunday_close_afternoon;
                            $openinghour->opentime_in_min = ((int)explode(':', $request->sunday_open_afternoon)[0] * 60) + (int)explode(':', $request->sunday_open_afternoon)[1];
                            $openinghour->closetime_in_min = ((int)explode(':', $request->sunday_close_afternoon)[0] * 60) + (int)explode(':', $request->sunday_close_afternoon)[1];
                            $openinghour->business_id = $id;
        
                            $openinghour->save();
                        }
                    }
                }

               
                return redirect(route('account'));

            } else {
                return redirect('/')->with('message', 'Er ging iets fout');
            }
        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }



    
    public function deleteaccount(Request $request)
    {
        if (session()->get('logged_in')) {

            $usertype = session()->get('account_type');
            $id = session()->get('account_data')->id;

            $userdata = User::where('id', $id)->first();
            
            if ($usertype == 'klant') {
                
                $extradata = Client::where('user_id', $id)->first();

                
                return view('account.index', compact('userdata', 'extradata'));

            } elseif ($usertype == 'zaak') {
                
                $extradata = Business::where('user_id', $id)->first();

                //$businesshours = OpeningHour::where('business_id', $extradata->id)->get();
                
               
                return view('account.index');

            } else {
                return redirect('/')->with('message', 'Er ging iets fout');
            }
        } else {
            
            return redirect('/')->with('message', 'Je bent niet ingelogd');
        }
    }
}
