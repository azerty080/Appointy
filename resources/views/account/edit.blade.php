@extends('layouts.app')

@section('title', 'Account aanpassen')


@section('content')
    <h1>Account aanpassen</h1>

    <div class="contentDiv">

        <form method="POST" action="{{ route('updateaccount') }}">
            @csrf

            
        @if(session()->get('account_type') == 'klant')

            <div class="clientForm">
            
                <h2>Klant account</h2>
                
                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Voornaam</label>
                        <input name="firstname" type="text" value="{{ $accountdata->firstname }}">
                    </div>

                    <div class="soloInput">
                        <label>Achternaam</label>
                        <input name="lastname" type="text" value="{{ $accountdata->lastname }}">
                    </div>

                    <div class="soloInput">
                        <label>Geboortedatum</label>
                        <input class="birthdate" name="birthdate" type="date" value="{{ $accountdata->birthdate }}">
                    </div>
                </div>


                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Gemeente</label>
                        <input name="township" type="text" value="{{ $accountdata->user->township }}">
                    </div>

                    <div class="soloInput">
                        <label>Adres</label>
                        <input name="address" type="text" value="{{ $accountdata->user->address }}">
                    </div>

                    <div class="soloInput">
                        <label>Telefoonnummer</label>
                        <input class="phonenumber" name="phonenumber" type="text" value="{{ $accountdata->user->phonenumber }}">
                    </div>
                </div>


                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Email</label>
                        <input name="email" type="email" value="{{ $accountdata->user->email }}">
                    </div>
                </div>
                
                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Oud wachtwoord</label>
                        <input name="oldpassword" type="password">
                    </div>

                    <div class="soloInput">
                        <label>Wachtwoord</label>
                        <input name="password" type="password">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig wachtwoord</label>
                        <input name="password_confirmation" type="password">
                    </div>
                </div>
            </div>


        @elseif(session()->get('account_type') == 'zaak')

            <div class="businessForm">
                <h2>Zaak account</h2>


                <div class="inputGroup">
                    <div class="soloGroup">
                        <div class="soloInput">
                            <label>Naam</label>
                            <input class="name" name="name" type="text" value="{{ $accountdata->name }}">
                        </div>

                        <div class="soloInput">
                            <label>Beschrijving</label>
                            <textarea name="description" rows="4" cols="50">{{ $accountdata->description }}</textarea>
                        </div>
                    </div>


                    <div class="soloGroup">
                        <div class="soloInput">
                            <label>Beroep</label>
                            <input class="profession" name="profession" type="text" value="{{ $accountdata->profession }}">
                        </div>
                    </div>
                </div>


                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Gemeente</label>
                        <input name="township" type="text" value="{{ $accountdata->user->township }}">
                    </div>

                    <div class="soloInput">
                        <label>Adres</label>
                        <input name="address" type="text" value="{{ $accountdata->user->address }}">
                    </div>

                    <div class="soloInput">
                        <label>Telefoonnummer</label>
                        <input class="phonenumber" name="phonenumber" type="text" value="{{ $accountdata->user->phonenumber }}">
                    </div>
                </div>

                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Email</label>
                        <input name="email" type="email" value="{{ $accountdata->user->email }}">
                    </div>
                </div>

                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Oud wachtwoord</label>
                        <input name="oldpassword" type="password">
                    </div>

                    <div class="soloInput">
                        <label>Wachtwoord</label>
                        <input name="password" type="password">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig wachtwoord</label>
                        <input name="password_confirmation" type="password">
                    </div>
                </div>
                


                <div class="checkboxDiv">
                    <input type="checkbox" name="allow_guests" value="true" id="allow_guests" @if($accountdata->allow_guests) checked @endif><label for="allow_guests">Klanten zonder account een afspraak laten maken</label>
                </div>

                <h2>Lengte afspraak</h2>
                <div class="soloInput">
                    <select class="appointmentduration" name="appointmentduration">
                        <option value="15" @if($accountdata->appointmentduration == 15) selected @endif>15 min</option>
                        <option value="30" @if($accountdata->appointmentduration == 30) selected @endif>30 min</option>
                        <option value="60" @if($accountdata->appointmentduration == 60) selected @endif>1 uur</option>
                    </select>
                </div>
                
            </div>
        @endif

            <button type="submit">Account aanpassen</button>
        </form>
        
    </div>

@stop