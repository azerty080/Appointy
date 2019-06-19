@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <h1>Home</h1>

    <div class="contentDiv">
        @if(session()->has('logged_in'))
            @if(session()->get('account_type') == 'klant')

                <h2 class="botmargin">Favorieten</h2>
                @if(count($bookmarks) <= 0)
                    <p>Je hebt nog geen favorieten toegevoegd</p>
                @endif

                @foreach($bookmarks as $bookmark)

                    <a class="searchedBusiness" href="{{ route('businessdetail', ['name' => $bookmark->business->name, 'id' => $bookmark->business_id]) }}">
            
                        <div class="mainInfo">
                            <h2 class="name">{{ $bookmark->business->name }}</h2>
                            <p class="profession">{{ $bookmark->business->profession }}</p>
                        </div>
                        
                        <div class="locationInfo">
                            <p class="township">{{ $bookmark->business->user->township }}</p>
                            <p class="address">{{ $bookmark->business->user->address }}</p>
                        </div>
                    </a>

                    
                @endforeach
        
            @elseif(session()->get('account_type') == 'zaak')
                <h2 class="botmargin">Afspraken van vandaag</h2>
                
                @php
                    $clientAppointmentCounter = 0;
                @endphp

                <div class="appointmentOverview">
                    @foreach($appointments as $appointment)
                        
                        @if($appointment->client_id == null)
                            <div class="singleAppointment">
                                <p>Afspraak op {{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                                <p>Met {{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                                <p>Reden: {{ $appointment->details }}</p>

                                <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">Meer details</h4>

                                <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                    <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->birthdate)->format('d/m/Y') }}</p>
                                    <p>Email: {{ $appointment->email }}</p>
                                    <p>Telefoonnummer: {{ $appointment->phonenumber }}</p>

                                    <p>Gemeente: {{ $appointment->township }}</p>
                                    <p>Adres: {{ $appointment->address }}</p>   
                                </div>
                            </div>
                        @else
                            <div class="singleAppointment">
                                <p>Afspraak op {{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                                <p>Met {{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                                <p>Reden: {{ $appointment->details }}</p>

                                <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">Meer details</h4>

                                <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                    <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('d/m/Y') }}</p>
                                    
                                    <p>Email: {{ $appointment->client->user->email }}</p>
                                    <p>Telefoonnummer: {{ $appointment->client->user->phonenumber }}</p>

                                    <p>Gemeente: {{ $appointment->client->user->township }}</p>
                                    <p>Adres: {{ $appointment->client->user->address }}</p>  
                                </div>
                            </div>

                            @php $clientAppointmentCounter++ @endphp
                        @endif
                    @endforeach
                </div>

                @if($clientAppointmentCounter == 0)
                    <p>U hebt geen afspraken voor vandaag</p>
                @endif

            @endif
        @endif



        @if(session()->get('account_type') == 'klant' || !session()->has('logged_in'))
            <h2>Zoek zaak</h2>

            <form class="searchForm"method="GET" action="{{ route('searchresults') }}">
                
                <input class="name" name="name" type="text" placeholder="Naam van de zaak">

                <div class="lineWrapper">
                    <div class="line"></div>
                    <p>OF</p>
                </div>

                <input class="profession" name="profession" type="text" placeholder="Beroep">
                
                <input class="township" name="township" type="text" placeholder="Gemeente">
            
                <button type="submit">Zoek</button>
            </form>
        @endif
    </div>

@stop





@section('script')
    
    <script>
        
        function openDetails(id) {
            var div = document.getElementById("appointment" + id);

            div.classList.toggle('hide');
        }

    </script>
    
@stop