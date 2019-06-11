@extends('layouts.app')

@section('title', 'Account')


@section('content')
    <h1>Account</h1>

 
    @if(session()->get('user_type') == 'klant')

        <h2>Klantaccount informatie</h2>

        <p>Naam: {{ $extradata->firstname }} {{ $extradata->lastname }}</p>
        <p>Geboortedatum: {{ $extradata->birthdate }}</p>
        
        <p>Gemeente: {{ $userdata->township }}</p>
        <p>Adres: {{ $userdata->address }}</p>

        <p>Telefoonnummer: {{ $userdata->phonenumber }}</p>

        <p>Email: {{ $userdata->email }}</p>



    @elseif(session()->get('user_type') == 'zaak')

        <h2>Zaakaccount informatie</h2>


        <p>Naam: {{ $extradata->name }}</p>
        <p>Beroep: {{ $extradata->profession }}</p>
        
        <p>Beschrijving: {{ $extradata->description }}</p>

        <p>Gemeente: {{ $userdata->township }}</p>
        <p>Adres: {{ $userdata->address }}</p>

        <p>Telefoonnummer: {{ $userdata->phonenumber }}</p>

        <p>Email: {{ $userdata->email }}</p>



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


    @endif


@stop