<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>


        <nav>
            <div class="container">
                <a href="/">Home</a>
<!--
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    <a href="{{ route('logout') }}">Logout</a>
                @endguest
-->

                @if(session()->has('logged_in'))
                    <a href="{{ route('account') }}">Account</a>
                    <a href="{{ route('logout') }}">Uitloggen</a>
                @else 
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif

            </div>

        </nav>

        <main>

            <div class="container">
                <div class="message">
                    @if(session()->has('message'))
                        <div class="">
                            <p>{{ session()->get('message') }}</p>
                        </div>
                    @endif
                </div>

                @yield('content')
            </div>
        </main>

        @yield('script')
    </body>
</html>