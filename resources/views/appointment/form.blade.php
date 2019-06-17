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

    <h1>Afspraak maken bij {{ $name }} op @if(old('date')) {{ Carbon\Carbon::parse(old('date'))->format('d/m/Y') }} @else {{ Carbon\Carbon::parse($day)->format('d/m/Y') }} @endif om @if(old('time')) {{ old('time') }} @else {{ $timefull }} @endif</h1>


    <div class="contentDiv">
        <form method="POST" action="{{ route('createappointment') }}">
            @csrf


            @if(!session()->get('logged_in'))
                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Voornaam</label>
                        <input name="firstname" type="text">
                    </div>

                    <div class="soloInput">
                        <label>Achternaam</label>
                        <input name="lastname" type="text">
                    </div>
                        
                    <div class="soloInput">
                        <label>Geboortedatum</label>
                        <input name="birthdate" type="date">
                    </div>
                </div>
               
                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Gemeente</label>
                        <input name="township" type="text">
                    </div>

                    <div class="soloInput">
                        <label>Adres</label>
                        <input name="address" type="text">
                    </div>

                    <div class="soloInput">
                        <label>Telefoonnummer</label>
                        <input name="phonenumber" type="text">
                    </div>
                </div>


                <div class="soloInput">
                    <label>Email</label>
                    <input name="email" type="text">
                </div>
            @endif


            <div class="soloInput textAreaInput">
                <label>Reden voor afspraak</label>
                <textarea name="details" rows="4" cols="50"></textarea>
            </div>



            <div class="">
                <input class="id" name="business_id" type="number" @if(old('business_id')) value="{{ old('business_id') }}" @else value="{{ $id }}" @endif hidden>
            </div>

            <div class="">
                <input class="date" name="date" type="date" @if(old('date')) value="{{ old('date') }}" @else value="{{ $day }}" @endif hidden>
            </div>

            <div class="">
                <input class="time" name="time" type="time" @if(old('time')) value="{{ old('time') }}" @else value="{{ $timefull }}" @endif hidden>
            </div>

            <div class="">
                <input class="time_in_min" name="time_in_min" type="number" @if(old('time_in_min')) value="{{ old('time_in_min') }}" @else value="{{ $time }}" @endif hidden>
            </div>
            


            <div class="checkboxDiv formCheckBox">
                <input type="checkbox" name="sendreminder" value="true" id="sendreminder" @if(old('sendreminder')) checked="checked" @endif><label for="sendreminder" class="checkmark"></label><label for="sendreminder">Stuur herinnering via mail</label>
            </div>

            <div class="checkboxDiv formCheckBox">
                <input type="checkbox" name="notify" value="true" id="notify" @if(old('notify')) checked="checked" @endif><label for="notify" class="checkmark"></label><label for="notify">Stuur email als er een vroegere afspraak vrij komt</label>
            </div>
        


            <button type="submit">Afspraak aanmaken</button>

        </form>
    </div>

@stop