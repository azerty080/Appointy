@extends('layouts.app')

@section('title', 'Inloggen')


@section('content')

    <div class="col-lg-6 offset-lg-3">
        
        <h1>Inloggen</h1>

        <form id="loginForm" method="POST" action="{{ route('login') }}" role="form" data-toggle="validator">
            @csrf

            




            <div class="form-group">
                <input type="email" class="form-control-input" id="cemail" name="email" required>
                <label class="label-control" for="cemail">Email</label>
                <div class="help-block with-errors"></div>
            </div>


            <div class="form-group">
                <input type="password" class="form-control-input" id="cpassword" name="password" required>
                <label class="label-control" for="cpassword">Wachtwoord</label>
                <div class="help-block with-errors"></div>
            </div>

                    


            <div class="form-group">
                <button type="submit" class="form-control-submit-button">INLOGGEN</button>
            </div>
            



    <!--
            <div class="loginInputs">
                <div class="loginInputDiv">
                    <label for="email">Email</label>
                    <input name="email" type="text">
                </div>

                <div class="loginInputDiv">
                    <label for="password">Wachtwoord</label>
                    <input name="password" type="password">
                </div>
            </div>

            <button type="submit">INLOGGEN</button>
    -->
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