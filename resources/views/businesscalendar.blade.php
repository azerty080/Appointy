@extends('layouts.app')

@section('title', 'kalender')


@section('content')
    <h1><a href="/"><</a> xx/xx/xxxx - xx/xx/xxxx <a href="/">></a></h1>
   
    

    <h2>Openingsuren</h2>

        <h3>Maandag</h3>
        @foreach($mondayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

            @for ($i = (int)$hour->opentime; $i < (int)$hour->closetime; $i++)
                <p>{{ $i }}u00<p>
            @endfor

        @endforeach



        <h3>Dinsdag</h3>
        @foreach($tuesdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Woensdag</h3>
        @foreach($wednesdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Donderdag</h3>
        @foreach($thursdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Vrijdag</h3>
        @foreach($fridayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Zaterdag</h3>
        @foreach($saturdayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach



        <h3>Zondag</h3>
        @foreach($sundayhours as $hour)

            @if($hour->closed)
                <p>Gesloten</p>
            @else
                <p>{{ $hour->opentime }} - {{ $hour->closetime }}</p>
            @endif

        @endforeach


@stop