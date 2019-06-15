@extends('layouts.app')

@section('title', 'Inloggen')


@section('content')
    <h1>Inloggen</h1>

    <div class="contentDiv">
        <form class="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

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

            <button type="submit">Inloggen</button>

        </form>
    </div>
    
@stop