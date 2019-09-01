@extends('layouts.app')

@section('title', 'Registreren')


@section('content')


    <h1>Registreren als klant</h1>


    <form id="register-client-form" method="POST" action="{{ route('register-client-submit') }}" role="form" data-toggle="validator">
        @csrf

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
            <div class="form-group col-md-6">
                <input type="email" class="form-control-input" id="cemail" name="email" value="{{ old('email') }}" required>
                <label class="label-control" for="cemail">Email</label>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group col-md-6">
                <input type="email" class="form-control-input" id="cemail_confirmation" name="email_confirmation" required>
                <label class="label-control" for="cemail_confirmation">Bevestig email</label>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="password" class="form-control-input" id="cpassword" name="password" required>
                <label class="label-control" for="cpassword">Wachtwoord</label>
                <div class="help-block with-errors"></div>
            </div>
            
            <div class="form-group col-md-6">
                <input type="password" class="form-control-input" id="cpassword_confirmation" name="password_confirmation" required>
                <label class="label-control" for="cpassword_confirmation">Bevestig wachtwoord</label>
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="form-control-submit-button">REGISTREER</button>
        </div>
    </form>
    
    


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