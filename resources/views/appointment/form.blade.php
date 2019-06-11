@extends('layouts.app')

@section('title', 'Afspraak maken')


@section('content')

    @php
        $hour = floor($time/60);
        $min = $time%60;
        
        if($hour < 10) {
            $hour = '0' . $hour;
        }

        if($min == 0) {
            $min = '00';
        }

        $timefull = $hour . ':' . $min;
    
    @endphp

    <h1>Afspraak maken bij {{ $name }} op {{ Carbon\Carbon::parse($day)->format('d/m/Y') }} om {{ floor($time/60) }}:@if($time%60 == 0)00 @else{{ $time%60 }} @endif</h1>
    
    <form method="POST" action="{{ route('createappointment') }}">
        @csrf

   

        @if(!session()->get('logged_in'))
            <div class="">
                <label>Voornaam</label>
                <input name="firstname" type="text">
            </div>

            <div class="">
                <label>Achternaam</label>
                <input name="lastname" type="text">
            </div>

            <div class="">
                <label>Geboortedatum</label>
                <input name="birthdate" type="date">
            </div>

            <div class="">
                <label>Gemeente</label>
                <input name="township" type="text">
            </div>

            <div class="">
                <label>Adres</label>
                <input name="address" type="text">
            </div>

            <div class="">
                <label>Telefoonnummer</label>
                <input name="phonenumber" type="text">
            </div>

            <div class="">
                <label>Email</label>
                <input name="email" type="text">
            </div>
        @endif


        <div class="">
            <label>Reden voor afspraak</label>
            <textarea name="details" rows="4" cols="50"></textarea>
        </div>



        <div class="">
            <input class="id" name="business_id" type="number" value="{{ $id }}" hidden>
        </div>

        <div class="">
            <input class="date" name="date" type="date" value="{{ $day }}" hidden>
        </div>

        <div class="">
            <input class="time" name="time" type="time" value="{{ $timefull }}" hidden>
        </div>

        <div class="">
            <input class="time_in_min" name="time_in_min" type="number" value="{{ $time }}" hidden>
        </div>
        


        <div class="checkboxDiv">
            <input type="checkbox" name="sendreminder" value="true" id="sendreminder"><label for="sendreminder">Stuur herinnering via mail</label>
        </div>

        <div class="checkboxDiv">
            <input type="checkbox" name="notify" value="true" id="notify"><label for="notify">Stuur email als er een vroegere afspraak vrij komt</label>
        </div>
    


        <button type="submit">Afspraak aanmaken</button>

    </form>
    

@stop