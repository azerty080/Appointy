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

        <h3>Maandag</h3>
        @foreach($mondayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Dinsdag</h3>
        @foreach($tuesdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Woensdag</h3>
        @foreach($wednesdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Donderdag</h3>
        @foreach($thursdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Vrijdag</h3>
        @foreach($fridayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Zaterdag</h3>
        @foreach($saturdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Zondag</h3>
        @foreach($sundayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach


    @endif


@stop