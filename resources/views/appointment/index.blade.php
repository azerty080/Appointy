@extends('layouts.app')

@section('title', 'Afspraken')


@section('content')

    <h1>Gemaakte afspraken</h1>
    

    @if(session()->get('user_type') == 'klant')
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

    @elseif(session()->get('user_type') == 'zaak')
        <h2>Afspraken als zaak</h2>

        @foreach($appointments as $appointment)

            <p>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</p>
            <p>{{ $appointment->time }}</p>

            <p>{{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
            <p>{{ $appointment->client->birthdate }}</p>

            
            <p>{{ $appointment->client->user->email }}</p>
            <p>{{ $appointment->client->user->phonenumber }}</p>

            
            <p>{{ $appointment->client->user->township }}</p>
            <p>{{ $appointment->client->user->address }}</p>

            <p>{{ $appointment->details }}</p>



        @endforeach

    @else
        <p>Je moet ingelogd zijn om je afspraken te bekijken</p>
    @endif

    

@stop