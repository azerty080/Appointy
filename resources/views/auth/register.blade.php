@extends('layouts.app')

@section('title', 'Registreren')


@section('content')
    <h1>Registreren</h1>


    <div class="register-account-type">
        <h2>Account type:</h2>

        <a class="button-link" href="{{ route('register-client') }}">Klant</a>

        <a class="button-link" href="{{ route('register-business') }}">Zaak</a>
    </div>

        
@stop