@extends('layouts.app')

@section('title', 'Account')


@section('content')
    <h1>Account</h1>

    <div class="contentdiv">
        

        @if(session()->get('account_type') == 'klant')

            <h2>Account informatie</h2>

            <div class="account-info">
                <div class="info-group">
                    <div class="info-item">
                        <h3>Voornaam:</h3>
                        <p>{{ $userdata->firstname }}</p>
                    </div>

                    <div class="info-item">
                        <h3>Adres:</h3>
                        <p>{{ $userdata->user->address }}</p>
                    </div>

                    <div class="info-item">
                        <h3>Email:</h3>
                        <p>{{ $userdata->user->email }}</p>
                    </div>
                </div>

                
                <div class="info-group">
                    <div class="info-item">
                        <h3>Achternaam:</h3>
                        <p>{{ $userdata->lastname }}</p>
                    </div>

                    <div class="info-item">
                        <h3>Gemeente:</h3>
                        <p>{{ $userdata->user->township }}</p>
                    </div>
                </div>

                
                <div class="info-group">
                    <div class="info-item">
                        <h3>Geboortedatum:</h3>
                        <p>{{ Carbon\Carbon::parse($userdata->birthdate)->format('d-m-Y') }}</p>
                    </div>

                    <div class="info-item">
                        <h3>Telefoonnummer:</h3>
                        <p>{{ $userdata->user->phonenumber }}</p>
                    </div>
                </div>
            </div>

            
            <div class="account-info-mobile">
                <div class="info-item">
                    <h3>Voornaam:</h3>
                    <p>{{ $userdata->firstname }}</p>
                </div>

                <div class="info-item">
                    <h3>Achternaam:</h3>
                    <p>{{ $userdata->lastname }}</p>
                </div>

                <div class="info-item">
                    <h3>Geboortedatum:</h3>
                    <p>{{ Carbon\Carbon::parse($userdata->birthdate)->format('d-m-Y') }}</p>
                </div>

                <div class="info-item">
                    <h3>Adres:</h3>
                    <p>{{ $userdata->user->address }}</p>
                </div>

                <div class="info-item">
                    <h3>Gemeente:</h3>
                    <p>{{ $userdata->user->township }}</p>
                </div>

                <div class="info-item">
                    <h3>Email:</h3>
                    <p>{{ $userdata->user->email }}</p>
                </div>
            
                <div class="info-item">
                    <h3>Telefoonnummer:</h3>
                    <p>{{ $userdata->user->phonenumber }}</p>
                </div>
            </div>

            <div class="individual-btn-link">
                <a class="button-link" href="{{ route('editaccount') }}">ACCOUNTINFO AANPASSEN</a>
            </div>
            
            <div class="individual-btn-link">
                <a class="button-link" href="{{ route('editpassword') }}">WACHTWOORD VERANDEREN</a>
            </div>

            <h4 onclick="showDeleteClient()" id="deleteClient" class="deleteClient">ACCOUNT VERWIJDEREN</h4>

            <form id="deleteClientForm" class="hide" method="POST" action="{{ route('deleteaccount') }}">
                @csrf
                
                <input name="user_id" type="number" value="{{ $userdata->user->id }}" hidden>
                <input name="account_id" type="number" value="{{ $userdata->id }}" hidden>


                <button type="submit" class="form-control-submit-button deleteClient secondBtn">VERWIJDER ACCOUNT</button>
                
                <button type="button" class="deleteClient secondBtn noBtn" onclick="clickedNo('deleteClientForm')">ANNULEER</button>
            </form>


        @elseif(session()->get('account_type') == 'zaak')

            <div class="business-account">

                <div class="account-info">
                    <div class="info-group">
                        <div class="info-item">
                            <h4>Naam:</h4>
                            <p>{{ $userdata->name }}</p>
                        </div>

                        <div class="info-item">
                            <h4>Adres:</h4>
                            <p>{{ $userdata->user->address }}</p>
                        </div>
                    </div>

                    
                    <div class="info-group">
                        <div class="info-item">
                            <h4>Beroep:</h4>
                            <p>{{ $userdata->profession }}</p>
                        </div>

                        <div class="info-item">
                            <h4>Gemeente:</h4>
                            <p>{{ $userdata->user->township }}</p>
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="info-item">
                            <h4>Email:</h4>
                            <p>{{ $userdata->user->email }}</p>
                        </div>

                        <div class="info-item">
                            <h4>Telefoonnummer:</h4>
                            <p>{{ $userdata->user->phonenumber }}</p>
                        </div>
                    </div>
                </div>


                <div class="info-group">
                    <div class="info-item">
                            <h4>Beschrijving:</h4>
                            <p>{{ $userdata->description }}</p>
                        </div>

                    <div class="info-item">
                        <h4>Duurtijd afspraak:</h4>
                        <p>{{ $userdata->appointmentduration }} minuten</p>
                    </div>

                    <div class="info-item">
                        <h4>Niet ingelogde gebruikers toelaten:</h4>
                        <p>@if($userdata->allow_guests) JA @else NEE @endif</p>
                    </div>
                </div>

                <a class="button-link" href="{{ route('editaccount') }}">ACCOUNTINFO AANPASSEN</a>
                
                <a class="button-link" href="{{ route('editpassword') }}">WACHTWOORD VERANDEREN</a>
            </div>


            <div class="account-info-mobile">
                <div class="info-item">
                    <h4>Naam:</h4>
                    <p>{{ $userdata->name }}</p>
                </div>

                <div class="info-item">
                    <h4>Beroep:</h4>
                    <p>{{ $userdata->profession }}</p>
                </div>

                <div class="info-item">
                    <h4>Adres:</h4>
                    <p>{{ $userdata->user->address }}</p>
                </div>

                <div class="info-item">
                    <h4>Gemeente:</h4>
                    <p>{{ $userdata->user->township }}</p>
                </div>


                <div class="info-item">
                    <h4>Email:</h4>
                    <p>{{ $userdata->user->email }}</p>
                </div>

                <div class="info-item">
                    <h4>Telefoonnummer:</h4>
                    <p>{{ $userdata->user->phonenumber }}</p>
                </div>

                <div class="info-item">
                    <h4>Beschrijving:</h4>
                    <p>{{ $userdata->description }}</p>
                </div>

                <div class="info-item">
                    <h4>Duurtijd afspraak:</h4>
                    <p>{{ $userdata->appointmentduration }} minuten</p>
                </div>

                <div class="info-item">
                    <h4>Niet ingelogde gebruikers toelaten:</h4>
                    <p>@if($userdata->allow_guests) JA @else NEE @endif</p>
                </div>

                <div class="individual-btn-link">
                    <a class="button-link" href="{{ route('editaccount') }}">ACCOUNTINFO AANPASSEN</a>
                </div>
                
                <div class="individual-btn-link">
                    <a class="button-link" href="{{ route('editpassword') }}">WACHTWOORD VERANDEREN</a>
                </div>
            </div>


            <div class="openingHours">
                <h2>Openingsuren</h2>
                
            
                <div class="openingHour">
                    <h4>Maandag:</h4>
                    @foreach($mondayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                

                <div class="openingHour">
                    <h4>Dinsdag:</h4>
                    @foreach($tuesdayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                

                <div class="openingHour">
                    <h4>Woensdag:</h4>
                    @foreach($wednesdayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                

                <div class="openingHour">
                    <h4>Donderdag:</h4>
                    @foreach($thursdayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                

                <div class="openingHour">
                    <h4>Vrijdag:</h4>
                    @foreach($fridayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                

                <div class="openingHour">
                    <h4>Zaterdag:</h4>
                    @foreach($saturdayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>
            
                
                <div class="openingHour">
                    <h4>Zondag:</h4>
                    @foreach($sundayhours as $hour)
                        @if($hour->closed)
                            <p colspan="2">Gesloten</p>
                        @else
                            <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                        @endif
                    @endforeach
                </div>

                <a class="button-link" href="{{ route('editopeninghours') }}">OPENINGSUREN AANPASSEN</a>
            </div>


            
            <h4 onclick="showDeleteBusiness()" id="deleteBusiness" class="deleteBusiness">ACCOUNT VERWIJDEREN</h4>
    
                
            <form id="deleteBusinessForm" class="hide" method="POST" action="{{ route('deleteaccount') }}">
                @csrf
                
                <h3>Ben je zeker dat je dit account wil verwijderen?</h3>
                <input name="user_id" type="number" value="{{ $userdata->user->id }}" hidden>
                <input name="account_id" type="number" value="{{ $userdata->id }}" hidden>

                <button type="submit" class="form-control-submit-button deleteBusiness secondBtn">VERWIJDER ACCOUNT</button>
           
                <button type="button" class="deleteBusiness secondBtn noBtn" onclick="clickedNo('deleteBusinessForm')">ANNULEER</button>
            </form>

        </div>


    @endif



@stop



@section('script')

    <script>
        function showDeleteClient() {
            var div = document.getElementById("deleteClientForm");

            div.classList.toggle('hide');
        }

        function showDeleteBusiness() {
            var div = document.getElementById("deleteBusinessForm");

            div.classList.toggle('hide');
        }

        function clickedNo(name) {
            var div = document.getElementById(name);

            div.classList.toggle('hide');
        }
    </script>

@stop