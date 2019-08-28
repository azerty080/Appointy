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
        <form method="POST" action="{{ route('createappointment') }}" role="form" data-toggle="validator">
            @csrf


            @if(!session()->get('logged_in'))

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control-input" id="cfirstname" name="firstname" value="{{ old('firstname') }}" required>
                        <label class="label-control" for="cfirstname">Voornaam</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-5">
                        <input type="text" class="form-control-input" id="clastname" name="lastname" value="{{ old('lastname') }}" required>
                        <label class="label-control" for="clastname">Achternaam</label>
                        <div class="help-block with-errors"></div>
                    </div>
                        
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control-input" id="cbirthdate" name="birthdate" value="{{ old('birthdate') }}" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" min="1900-01-01" max="2019-01-01" required>
                        <label class="label-control" for="cbirthdate">Geboortedatum</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control-input" id="caddress" name="address" value="{{ old('address') }}" required>
                        <label class="label-control" for="caddress">Adres</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-5">
                        <input type="text" class="form-control-input" id="ctownship" name="township" value="{{ old('township') }}" required>
                        <label class="label-control" for="ctownship">Gemeente</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <input type="text" class="form-control-input" id="cphonenumber" name="phonenumber" value="{{ old('phonenumber') }}" required>
                        <label class="label-control" for="cphonenumber">Telefoonnummer</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="email" class="form-control-input" id="cemail" name="email" value="{{ old('email') }}" required>
                        <label class="label-control" for="cemail">Email</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            @endif


            <div class="form-row">
                <div class="form-group col-md-4">
                    <textarea class="form-control-textarea" id="cdetails" name="details" required></textarea>
                    <label class="label-control" for="cdetails">Reden voor afspraak</label>
                    <div class="help-block with-errors"></div>
                </div>
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
            


            <div class="form-group checkbox">
                <input type="checkbox" id="notify" name="notify" value="notify" @if(old('notify')) checked="checked" @endif>
                <label for="notify">Stuur email als er een vroegere afspraak vrij komt</label>
                <div class="help-block with-errors"></div>
            </div>



            <div class="form-group">
                <button type="submit" class="form-control-submit-button">AFSPRAAK AANMAKEN</button>
            </div>
        </form>



        
    </div>

@stop





@section('script')
    
    <script>
            
        $("input, textarea").keyup(function(){
            if ($(this).val() != '') {
                $(this).addClass('notEmpty');
            } else {
                $(this).removeClass('notEmpty');
            }
        });

    </script>
    
@stop