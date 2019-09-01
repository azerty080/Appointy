@extends('layouts.app')

@section('title', $business->name)


@section('content')
    <div class="businessDetails">
        <div class="titleDiv">
            <div class="titleInfo">
                <h1>{{ $business->name }}</h1>
                <h3>{{ $business->profession }}</h3>
                <p>{{ $business->description }}</p>
            </div>

            @if(session()->has('logged_in'))
                @if($isbookmarked)
                    <form method="POST" action="{{ route('removebookmark', ['name' => $business->name, 'id' => $business->id]) }}">
                        @csrf

                        <input name="business_id" type="number" value="{{ $business->id }}" hidden>
                        
                        <button type="submit">VERWIJDER VAN FAVORIETEN</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('addbookmark', ['name' => $business->name, 'id' => $business->id]) }}">
                        @csrf

                        <input name="business_id" type="number" value="{{ $business->id }}" hidden>
                        
                        <button type="submit">TOEVOEGEN AAN FAVORIETEN</button>
                    </form>
                @endif
            @endif
        </div>

        <div class="contentDiv businessInfo">
            <div class="mainBusinessInfo">
                <div class="details">
                    <p>Adres: {{ $business->user->address }}, {{ $business->user->township }}</p>
                    
                    <p>Email: {{ $business->user->email }}</p>

                    <p>Telefoonnummer: {{ $business->user->phonenumber }}</p>
                </div>

                
                <div class="openingHours">
                    <h2>Openingsuren</h2>
                    
                    <table class="businessDetailTable">

                        <tr>
                            <th class="detail-long-table-days">Maandag</th>
                            <th class="detail-short-table-days">Ma</th>
                            @foreach($mondayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Dinsdag</th>
                            <th class="detail-short-table-days">Di</th>
                            @foreach($tuesdayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Woensdag</th>
                            <th class="detail-short-table-days">Wo</th>
                            @foreach($wednesdayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Donderdag</th>
                            <th class="detail-short-table-days">Do</th>
                            @foreach($thursdayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Vrijdag</th>
                            <th class="detail-short-table-days">Vr</th>
                            @foreach($fridayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Zaterdag</th>
                            <th class="detail-short-table-days">Za</th>
                            @foreach($saturdayhours as $hour)
                                @if($hour->closed)
                                    <td colspan="2">Gesloten</td>
                                @else
                                    <td>{{ $hour->opentime }} - {{ $hour->closetime }}</td>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="detail-long-table-days">Zondag</th>
                            <th class="detail-short-table-days">Zo</th>
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
                    <a class="button-link" href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
                @else
                    @if(session()->has('logged_in'))
                        <a class="button-link" href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
                    @else
                        <button class="disabledBtn" disabled>Je moet ingelogd zijn om bij deze zaak een afspraak te maken</button>
                    @endif
                @endif
            </div>
        </div>
    </div>

@stop