@extends('layouts.app')

@section('title', 'Wachtwoord aanpassen')


@section('content')
    <h1>Account aanpassen</h1>

    <div class="contentDiv">

        <form method="POST" action="{{ route('updatepassword') }}" role="form" data-toggle="validator">
            @csrf

            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" class="form-control-input" id="coldpassword" name="oldpassword" required>
                    <label class="label-control" for="coldpassword">Oud wachtwoord</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" class="form-control-input" id="cpassword" name="password" required>
                    <label class="label-control" for="cpassword">Nieuw wachtwoord</label>
                    <div class="help-block with-errors"></div>
                </div>
                
                <div class="form-group col-md-6">
                    <input type="password" class="form-control-input" id="cpassword_confirmation" name="password_confirmation" required>
                    <label class="label-control" for="cpassword_confirmation">Bevestig wachtwoord</label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="form-control-submit-button">VERANDER WACHTWOORD</button>
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