@extends('layouts.app')

@section('title', 'Login')


@section('content')
    <h1>Inloggen</h1>


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="">
            <label for="email">Email</label>
            <input name="email" type="text">
        </div>

        <div class="">
            <label for="password">Wachtwoord</label>
            <input name="password" type="password">
        </div>

        <button type="submit">Inloggen</button>

    </form>
    
@stop