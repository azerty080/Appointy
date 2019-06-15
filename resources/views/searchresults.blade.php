@extends('layouts.app')

@section('title', 'Zoekresultaten')


@section('content')
    <h1>Zoekresultaten</h1>

    <div class="contentDiv">
        <div class="searchResults">
            @foreach($businesses as $business)

                <a class="searchedBusiness" href="{{ route('businessdetail', ['name' => $business->name, 'id' => $business->id]) }}">
                    <div class="mainInfo">
                        <h2 class="name">{{ $business->name }}</h2>
                        <p class="profession">{{ $business->profession }}</p>
                    </div>
                    
                    <div class="locationInfo">
                        <p class="township">{{ $business->user->township }}</p>
                        <p class="address">{{ $business->user->address }}</p>
                    </div>
                </a>

            @endforeach
        </div>
    </div>

@stop