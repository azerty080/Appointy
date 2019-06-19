@extends('layouts.app')

@section('title', 'Account')


@section('content')
    <h1>Account</h1>

    <div class="contentDiv accountInfo">
        <div class="details">
            
            <h2>Account informatie</h2>

            @if(session()->get('account_type') == 'klant')

                <div class="infoGroup">
                    <h3>Naam:</h3>
                    <p>{{ $userdata->firstname }} {{ $userdata->lastname }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Geboortedatum:</h3>
                    <p>Geboortedatum: {{ $userdata->birthdate }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Gemeente:</h3>
                    <p>{{ $userdata->user->township }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Adres:</h3>
                    <p>{{ $userdata->user->address }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Telefoonnummer:</h3>
                    <p>{{ $userdata->user->phonenumber }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Email:</h3>
                    <p>{{ $userdata->user->email }}</p>
                </div>

                <a class="linkBtn" href="{{ route('editaccount') }}">Accountinformatie aanpassen</a>


                <h4 onclick="showDeleteClient()" id="deleteClient" class="deleteClient">Account verwijderen</h4>

                <form id="deleteClientForm" class="hide" method="POST" action="{{ route('deleteaccount') }}">
                    @csrf
                    
                    <input name="user_id" type="number" value="{{ $userdata->user->id }}" hidden>
                    <input name="account_id" type="number" value="{{ $userdata->id }}" hidden>

                    <button type="submit">Verwijder account</button>
                    <a class="linkBtn noBtn" onclick="clickedNo('deleteClientForm')">Niet verwijderen</a>
                </form>


            @elseif(session()->get('account_type') == 'zaak')

            
                <div class="infoGroup">
                    <h3>Naam:</h3>
                    <p>{{ $userdata->name }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Beroep:</h3>
                    <p>{{ $userdata->profession }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Beschrijving:</h3>
                    <p>{{ $userdata->description }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Gemeente:</h3>
                    <p>{{ $userdata->user->township }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Adres:</h3>
                    <p>{{ $userdata->user->address }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Telefoonnummer:</h3>
                    <p>{{ $userdata->user->phonenumber }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Email:</h3>
                    <p>{{ $userdata->user->email }}</p>
                </div>

                <div class="infoGroup">
                    <h3>Niet ingelogde gebruikers toelaten:</h3>
                    <p>@if($userdata->allow_guests) JA @else NEE @endif</p>
                </div>

                <div class="infoGroup">
                    <h3>Duurtijd afspraak:</h3>
                    <p>{{ $userdata->appointmentduration }} minuten</p>
                </div>

                <a class="linkBtn" href="{{ route('editaccount') }}">Accountinformatie aanpassen</a>

                
                <h4 onclick="showDeleteBusiness()" id="deleteBusiness" class="deleteBusiness">Account verwijderen</h4>

                <form id="deleteBusinessForm" class="hide" method="POST" action="{{ route('deleteaccount') }}">
                    @csrf
                    
                    <input name="user_id" type="number" value="{{ $userdata->user->id }}" hidden>
                    <input name="account_id" type="number" value="{{ $userdata->id }}" hidden>

                    <button type="submit">Verwijder account</button>
                    <a class="linkBtn noBtn" onclick="clickedNo('deleteBusinessForm')">Niet verwijderen</a>
                </form>
            </div>

            <div class="openingHours">
                <h2>Openingsuren</h2>
                
                <table class="businessDetailTable">

                    <tr>
                        <th>Maandag</th>
                        @foreach($mondayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Dinsdag</th>
                        @foreach($tuesdayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Woensdag</th>
                        @foreach($wednesdayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Donderdag</th>
                        @foreach($thursdayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Vrijdag</th>
                        @foreach($fridayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Zaterdag</th>
                        @foreach($saturdayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Zondag</th>
                        @foreach($sundayhours as $hour)
                            @if($hour->closed)
                                <td colspan="2">Gesloten</td>
                            @else
                                <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                            @endif
                        @endforeach
                    </tr>
                </table>
                
                <a class="linkBtn" href="{{ route('editopeninghours') }}">Openingsuren aanpassen</a>
            </div>

        </div>


        @endif
    </div>


    

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