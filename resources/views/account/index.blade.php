@extends('layouts.app')

@section('title', 'Account')


@section('content')
    <h1>Account</h1>

    <div class="contentDiv">
        @if(session()->get('account_type') == 'klant')

            <h2>Klantaccount informatie</h2>

            <p>Naam: {{ $userdata->firstname }} {{ $userdata->lastname }}</p>
            <p>Geboortedatum: {{ $userdata->birthdate }}</p>
            
            <p>Gemeente: {{ $userdata->user->township }}</p>
            <p>Adres: {{ $userdata->user->address }}</p>

            <p>Telefoonnummer: {{ $userdata->user->phonenumber }}</p>

            <p>Email: {{ $userdata->user->email }}</p>

            <a href="{{ route('editaccount') }}">Accountinformatie aanpassen</a>

        @elseif(session()->get('account_type') == 'zaak')

            <h2>Zaakaccount informatie</h2>


            <p>Naam: {{ $userdata->name }}</p>
            <p>Beroep: {{ $userdata->profession }}</p>
            
            <p>Beschrijving: {{ $userdata->description }}</p>

            <p>Gemeente: {{ $userdata->user->township }}</p>
            <p>Adres: {{ $userdata->user->address }}</p>

            <p>Telefoonnummer: {{ $userdata->user->phonenumber }}</p>

            <p>Email: {{ $userdata->user->email }}</p>


            <p>Niet ingelogde gebruikers toelaten: @if($userdata->allow_guests) JA @else NEE @endif</p>
            
            <p>Duurtijd afspraak: {{ $userdata->appointmentduration }} minuten</p>

            <a href="{{ route('editaccount') }}">Accountinformatie aanpassen</a>


            <h2>Openingsuren</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Maandag</th>
                        <th>Dinsdag</th>
                        <th>Woensdag</th>
                        <th>Donderdag</th>
                        <th>Vrijdag</th>
                        <th>Zaterdag</th>
                        <th>Zondag</th>
                    </tr>
                </thead>

                <tbody>

                        <tr>
                            <td>
                                @foreach($mondayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($tuesdayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($wednesdayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($thursdayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($fridayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($saturdayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($sundayhours as $hour)
                                    @if($hour->closed)
                                        <p>Gesloten</p>
                                    @else
                                        <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                </tbody>
            </table>

            <a href="{{ route('editopeninghours') }}">Openingsuren aanpassen</a>

        @endif
    </div>

@stop