@extends('layouts.app')

@section('title', 'Zoekresultaten')


@section('content')
    <h1>Zoekresultaten</h1>

    <div class="searchResults">

        @php $counter = 0; @endphp

        @foreach($businesses as $business)
        
            @if($business->user)
                <a class="searchedBusiness" href="{{ route('businessdetail', ['name' => $business->name, 'id' => $business->id]) }}">
                    <div class="mainInfo">
                        <h2 class="name">{{ $business->name }}</h2>
                        <p class="profession">{{ $business->profession }}</p>
                    </div>
                    
                    <div class="locationInfo">
                        <p class="township">{{ $business->user->township }}</p>
                        <p class="address">{{ $business->user->address }}</p>
                    </div>

                    
                    <div class="mobileInfo">
                        <h3 class="name">{{ $business->name }}</h3>
                        <p>{{ $business->profession }} in {{ $business->user->township }}</p>
                    </div>
                </a>
                
                @php $counter++; @endphp
            @endif

        @endforeach

        
        @if($counter == 0)
            <p>Geen zaken gevonden</p>
        @endif
    </div>


@stop