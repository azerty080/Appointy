@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <h1>Home</h1>


    @if(session()->has('logged_in'))
        <h2>Ingelogd als @if(session()->get('user_type') == 'klant') {{ session()->get('user_data')->firstname }} {{ session()->get('user_data')->lastname }} @else {{ session()->get('user_data')->name }} @endif</h2>

        @if(session()->get('user_type') == 'klant')

            @if(count($bookmarks) > 0)
                <h3>Favorieten</h3>
            @endif

            @foreach($bookmarks as $bookmark)

                <div>
                    <a href="{{ route('businessdetail', ['name' => $bookmark->business->name, 'id' => $bookmark->business_id]) }}">
                        <p>Naam: {{ $bookmark->business->name }}</p>
                        <p>Beroep: {{ $bookmark->business->profession }}</p>
                        
                        <p>Gemeente: {{ $bookmark->business->user->township }}</p>
                        <p>Adres: {{ $bookmark->business->user->address }}</p>
                    </a>
                </div>

            @endforeach

        @endif
    
    @else 
        <h2>Ingelogd als gast</h2>
    @endif



    @if(session()->get('user_type') == 'klant' || !session()->has('logged_in'))
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
    @endif


@stop