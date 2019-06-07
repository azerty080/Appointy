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


    <a href="{{ route('businesscalendar', ['name' => $business->name, 'id' => $business->id]) }}">Maak een afspraak</a>

@stop