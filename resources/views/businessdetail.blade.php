@extends('layouts.app')

@section('title', $business->name)


@section('content')
    <div class="businessDetails">
        <div class="titleDiv">
            <div class="titleInfo">
                <h1>{{ $business->name }}</h1>
                <h3>{{ $business->profession }}</h3>
            </div>

            @if(session()->has('logged_in'))
                @if($isbookmarked)
                    <form method="POST" action="{{ route('removebookmark', ['name' => $business->name, 'id' => $business->id]) }}">
                        @csrf

                        <input name="business_id" type="number" value="{{ $business->id }}" hidden>
                        
                        <button type="submit">Verwijder van favorieten</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('addbookmark', ['name' => $business->name, 'id' => $business->id]) }}">
                        @csrf

                        <input name="business_id" type="number" value="{{ $business->id }}" hidden>
                        
                        <button type="submit">Toevoegen aan favorieten</button>
                    </form>
                @endif
            @else
                <button class="disabledBtn" disabled>Je moet ingelogd zijn om favorieten toe te voegen</button>
            @endif
        </div>

        <div class="contentDiv businessInfo">
            <div class="mainBusinessInfo">
                <div class="details">
                    <div>
                        <h2>Beschrijving</h2>
                        <p>{{ $business->description }}</p>
                    </div>

                    <div>
                    <h2>Locatie</h2>
                        <p>Gemeente: {{ $business->user->township }}</p>
                        <p>Adres: {{ $business->user->address }}</p>
                    </div>

                    <div>
                    <h2>Contact</h2>
                        <p>Telefoonnummer: {{ $business->user->phonenumber }}</p>
                        <p>Email: {{ $business->user->email }}</p>
                    </div>
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
                </div>
            </div>
            
            <div class="createAppointment">
                @if($business->allow_guests)
                    <a class="linkBtn" href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
                @else
                    @if(session()->has('logged_in'))
                        <a class="linkBtn" href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
                    @else
                        <button class="disabledBtn" disabled>Je moet ingelogd zijn om bij deze zaak een afspraak te maken</button>
                    @endif
                @endif
            </div>
        </div>
    </div>

@stop