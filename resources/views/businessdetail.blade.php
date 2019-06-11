@extends('layouts.app')

@section('title', $business->name)


@section('content')
    <h1>{{ $business->name }}</h1>
    <h2>{{ $business->profession }}</h2>

    <p>{{ $business->description }}</p>

    <h3>Locatie</h3>
    <p>Gemeente: {{ $business->user->township }}</p>
    <p>Adres: {{ $business->user->address }}</p>


    <h3>Contact</h3>
    <p>Telefoonnummer: {{ $business->user->phonenumber }}</p>

    <p>Email: {{ $business->user->email }}</p>



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
        <p>Je moet ingelogd zijn om favorieten toe te voegen</p>
    @endif

    @if($business->allow_guests)
        <a href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
    @else
        @if(session()->has('logged_in'))
            <a href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id, 'addedweek' => 0]) }}">Maak een afspraak</a>
        @else
            <p>Je moet ingelogd zijn om bij deze zaak een afspraak te maken</p>
        @endif
    @endif


@stop