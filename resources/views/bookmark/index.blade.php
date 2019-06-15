@extends('layouts.app')

@section('title', 'Favorieten')


@section('content')

    <h1>Favorieten</h1>
    
    <div class="contentDiv">
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
    </div>

@stop