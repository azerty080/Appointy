@extends('layouts.app')

@section('title', 'Account aanpassen')


@section('content')
    <h1>Account aanpassen</h1>

    <div class="contentDiv">

        <form method="POST" action="{{ route('updateaccount') }}" role="form" data-toggle="validator">
            @csrf

            
        @if(session()->get('account_type') == 'klant')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control-input notEmpty" id="cfirstname" name="firstname" value="{{ $accountdata->firstname }}" required>
                    <label class="label-control" for="cfirstname">Voornaam</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-5">
                    <input type="text" class="form-control-input notEmpty" id="clastname" name="lastname" value="{{ $accountdata->lastname }}" required>
                    <label class="label-control" for="clastname">Achternaam</label>
                    <div class="help-block with-errors"></div>
                </div>
                    
                <div class="form-group col-md-3">
                    <input type="text" class="form-control-input notEmpty" id="cbirthdate" name="birthdate" value="{{ $accountdata->birthdate }}" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" min="1900-01-01" max="2019-01-01" required>
                    <label class="label-control" for="cbirthdate">Geboortedatum</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control-input notEmpty" id="caddress" name="address" value="{{ $accountdata->user->address }}" required>
                    <label class="label-control" for="caddress">Adres</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-5">
                    <input type="text" class="form-control-input notEmpty" id="ctownship" name="township" value="{{ $accountdata->user->township }}" required>
                    <label class="label-control" for="ctownship">Gemeente</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-3">
                    <input type="text" class="form-control-input notEmpty" id="cphonenumber" name="phonenumber" value="{{ $accountdata->user->phonenumber }}" required>
                    <label class="label-control" for="cphonenumber">Telefoonnummer</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="email" class="form-control-input notEmpty" id="cemail" name="email" value="{{ $accountdata->user->email }}" required>
                    <label class="label-control" for="cemail">Email</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            



        @elseif(session()->get('account_type') == 'zaak')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control-input notEmpty" id="cname" name="name" value="{{ $accountdata->name }}" required>
                    <label class="label-control" for="cname">Naam</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" class="form-control-input notEmpty" id="cprofession" name="profession" value="{{ $accountdata->profession }}" required>
                    <label class="label-control" for="cprofession">Beroep</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-group">
                <textarea type="text" class="form-control-input notEmpty" id="cdescription" name="description" required>{{ $accountdata->description }}</textarea>
                <label class="label-control" for="cdescription">Beschrijving</label>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control-input notEmpty" id="ctownship" name="township" value="{{ $accountdata->user->township }}" required>
                    <label class="label-control" for="ctownship">Gemeente</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-5">
                    <input type="text" class="form-control-input notEmpty" id="caddress" name="address" value="{{ $accountdata->user->address }}" required>
                    <label class="label-control" for="caddress">Adres</label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-md-3">
                    <input type="text" class="form-control-input notEmpty" id="cphonenumber" name="phonenumber" value="{{ $accountdata->user->phonenumber }}" required>
                    <label class="label-control" for="cphonenumber">Telefoonnummer</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="email" class="form-control-input notEmpty" id="cemail" name="email" value="{{ $accountdata->user->email }}" required>
                    <label class="label-control" for="cemail">Email</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="form-group checkbox">
                <input type="checkbox" id="callow_guests" name="allow_guests" value="true" @if($accountdata->allow_guests) checked="checked" @endif>
                <label for="callow_guests">Klanten zonder account een afspraak laten maken</label>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="appointmentduration">Lengte afspraak</label>

                    <select class="form-control" name="appointmentduration" id="appointmentduration">
                        <option value="15" @if($accountdata->appointmentduration == 15) selected @endif>15 min</option>
                        <option value="30" @if($accountdata->appointmentduration == 30) selected @endif>30 min</option>
                        <option value="60" @if($accountdata->appointmentduration == 60) selected @endif>1 uur</option>
                    </select>
                </div>
            </div>


                
        @endif
        
            <div class="form-group">
                <button type="submit" class="form-control-submit-button">ACCOUNT AANPASSEN</button>
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