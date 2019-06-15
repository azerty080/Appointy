@extends('layouts.app')

@section('title', 'Home')


@section('content')
    <h1>Home</h1>

    <div class="contentDiv">
        @if(session()->has('logged_in'))
            @if(session()->get('account_type') == 'klant')

                <h2>Favorieten</h2>
                @if(count($bookmarks) <= 0)
                    <p>Je hebt nog geen favorieten toegevoegd</p>
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
        
            @elseif(session()->get('account_type') == 'zaak')
                <h2>Zaak</h2>
                
            @endif
        @endif



        @if(session()->get('account_type') == 'klant' || !session()->has('logged_in'))
            <h2>Zoek zaak</h2>

            <form class="searchForm"method="GET" action="{{ route('searchresults') }}">
                
                <input class="name" name="name" type="text" placeholder="Naam van de zaak">

                <div class="lineWrapper">
                    <div class="line"></div>
                    <p>OF</p>
                </div>

                <input class="profession" name="profession" type="text" placeholder="Beroep">
                
                <input class="township" name="township" type="text" placeholder="Gemeente">
            
                <button type="submit">Zoek</button>
            </form>
        @endif
    </div>

@stop