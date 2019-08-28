@extends('layouts.app')

@section('title', 'Favorieten')


@section('content')

    <h1>Favorieten</h1>
    
    <div class="contentDiv">
        @foreach($bookmarks as $bookmark)

            <a class="searchedBusiness" href="{{ route('businessdetail', ['name' => $bookmark->business->name, 'id' => $bookmark->business_id]) }}">
                
                <div class="mainInfo">
                    <h2 class="name">{{ $bookmark->business->name }}</h2>
                    <p class="profession">{{ $bookmark->business->profession }}</p>
                </div>
                
                <div class="locationInfo">
                    <p class="township">{{ $bookmark->business->user->township }}</p>
                    <p class="address">{{ $bookmark->business->user->address }}</p>
                </div>

                
                <div class="mobileInfo">
                    <h3 class="name">{{ $bookmark->business->name }}</h3>
                    <p>{{ $bookmark->business->profession }} in {{ $bookmark->business->user->township }}</p>
                </div>
            </a>

        @endforeach
    </div>

@stop