@extends('layouts.app')

@section('title', 'Afspraken')


@section('content')

    <h1>Gemaakte afspraken</h1>
    
    <div class="contentDiv">
        @if(session()->get('account_type') == 'klant')
            <h2>Afspraken als klant</h2>

            @foreach($appointments as $appointment)

                <p>{{ $appointment }}</p>

                
                <p>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</p>
                <p>{{ $appointment->time }}</p>

                <p>{{ $appointment->business->name }}</p>
                <p>{{ $appointment->business->profession }}</p>

                <form method="POST" action="{{ route('removeappointment') }}">
                    @csrf

                    <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                    
                    <button type="submit">Afspraak annuleren</button>
                </form>

            @endforeach

        @elseif(session()->get('account_type') == 'zaak')
            <h2>Afspraken als zaak</h2>

            @foreach($appointments as $appointment)

                <p>Datum: {{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</p>
                <p>Tijdstip: {{ $appointment->time }}</p>

                <p>Reden voor afspraak: {{ $appointment->details }}</p>                

                @if($appointment->client_id == null)
                    <p>Naam: {{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                    <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->birthdate)->format('d/m/Y') }}</p>
                    
                    <p>Email: {{ $appointment->email }}</p>
                    <p>Telefoonnummer: {{ $appointment->phonenumber }}</p>
                    
                    <p>Gemeente: {{ $appointment->township }}</p>
                    <p>Adres: {{ $appointment->address }}</p>
                @else
                    <p>Naam: {{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                    <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('d/m/Y') }}</p>
                    
                    <p>Email: {{ $appointment->client->user->email }}</p>
                    <p>Telefoonnummer: {{ $appointment->client->user->phonenumber }}</p>

                    <p>Gemeente: {{ $appointment->client->user->township }}</p>
                    <p>Adres: {{ $appointment->client->user->address }}</p>
                @endif



            @endforeach

        @else
            <p>Je moet ingelogd zijn om je afspraken te bekijken</p>
        @endif
    </div>    

@stop