<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;

use App\User;
use App\Client;
use App\Business;

class LoginController extends Controller
{
    public function logout()
    {
        if (session('logged_in')) {
            session()->forget('logged_in');
            session()->forget('account_type');
            session()->forget('account_data');

            return redirect('/')->with('message', 'Je bent uitgelogd');
        } else {
            return redirect('/')->with('message', 'Je moet eerst ingelogd zijn voordat je kan uitloggen');
        }
    }



    public function login()
    {
        if (session('logged_in')) {
            return redirect('/')->with('message', 'Je bent al ingelogd');
        } else {
            return view('auth.login');
        }
    }



    public function loginsubmit(LoginRequest $request)
    {
        $email = $request->email;
        $password = hash("sha256", $request->password);

        $user = User::where('email', $email)->first();

        $client = Client::where('user_id', $user->id)->first();
        $business = Business::where('user_id', $user->id)->first();
        
        if ($client) {
            $usertype = 'klant';

            $userdata = Client::with('user')->where('user_id', $user->id)->first();
        } elseif ($business) {
            $usertype = 'zaak';
            
            $userdata = Business::with('user')->where('user_id', $user->id)->first();
        }
        

        if (sizeof($user) == 1 && $user->password == $password) {
            
            session(['logged_in' => true]);
            session(['account_type' => $usertype]);
            session(['account_data' => $userdata]);

            return redirect('/')->with('message', 'Je bent ingelogd');
        }
        else {
            
            return redirect()->back()->with('message', 'Inloggen mislukt, probeer nog eens');
        }
    }



}
