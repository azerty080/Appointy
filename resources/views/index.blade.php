@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <h1>Home</h1>


    @if(session()->has('logged_in'))
        <h2>Ingelogd als {{ session()->get('user_type') }} {{ session()->get('user_name') }}</h2>
    @else 
        <h2>Ingelogd als gast</h2>
    @endif



    
    <form method="GET" action="{{ route('searchresults') }}">

        <h2>Zoek zaak</h2>
        
        <div class="inputGroup">
            <div class="soloInput">
                <label>Naam van de zaak</label>
                <input name="name" type="text">
            </div>

            <p>OF</p>

            <div class="soloInput">
                <label>Beroep</label>
                <input name="profession" type="text">
            </div>

            <div class="soloInput">
                <label>Gemeente</label>
                <input name="township" type="text">
            </div>
        </div>
        
        <button type="submit">Zoek</button>
    </form>


@stop