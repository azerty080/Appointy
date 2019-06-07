@extends('layouts.app')

@section('title', 'Zoekresultaten')


@section('content')
    <h1>Zoekresultaten</h1>

    @foreach($businesses as $business)

        <div>
            <a href="{{ route('businessdetail', ['name' => $business->name, 'id' => $business->id]) }}">
                <p>Naam: {{ $business->name }}</p>
                <p>Beroep: {{ $business->profession }}</p>
                
                <p>Beschrijving: {{ $business->description }}</p>

                <p>Gemeente: {{ $business->user->township }}</p>
                <p>Adres: {{ $business->user->address }}</p>

                <p>Telefoonnummer: {{ $business->user->phonenumber }}</p>

                <p>Email: {{ $business->user->email }}</p>
            </a>
        </div>

    @endforeach

@stop