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
 
<!--
            <a href="/" class="{{ (Route::currentRouteName() == 'index') ? 'currentlink' : '' }}">Home</a>
-->
<!--
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="{{ route('logout') }}">Logout</a>
            @endguest
-->

            <a href="/" class="stealthlink logolink"><img class="logo" src="{{ asset('img/logo_white.svg') }}" alt="Logo"></a>


            @if(session()->has('logged_in'))
            
                <a class="stealthlink accountlink" href="{{ route('account') }}">{{ (session()->get('account_type') == 'klant') ? (session()->get('account_data')->firstname . ' ' . session()->get('account_data')->lastname) : session()->get('account_data')->name }}</a>
<!--
                <p>{{ (session()->get('account_type') == 'klant') ? (session()->get('account_data')->firstname . ' ' . session()->get('account_data')->lastname) : session()->get('account_data')->name }}</p>
                -->
                <a href="{{ route('appointments') }}" class="{{ (Route::currentRouteName() == 'appointments') ? 'currentlink' : '' }}">Afspraken</a>
                
                @if(session()->get('account_type') == 'klant')
                    <a href="{{ route('bookmarks') }}" class="{{ (Route::currentRouteName() == 'bookmarks') ? 'currentlink' : '' }}">Favorieten</a>
                @endif

                <a href="{{ route('account') }}" class="{{ (Route::currentRouteName() == 'account') ? 'currentlink' : '' }}">Mijn account</a>
                <a class="stealthlink logoutlink" href="{{ route('logout') }}" class="{{ (Route::currentRouteName() == 'logout') ? 'currentlink' : '' }}">Uitloggen</a>
            @else
                <a href="{{ route('login') }}" class="{{ (Route::currentRouteName() == 'login') ? 'currentlink' : '' }}">Inloggen</a>
                <a href="{{ route('register') }}" class="{{ (Route::currentRouteName() == 'register') ? 'currentlink' : '' }}">Registreren</a>
            @endif

        </nav>

        <div class="mainWrapper">
            <div class="topbar">
                <div class="message">
                    @if(session()->has('message'))
                        <div class="">
                            <p>{{ session()->get('message') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <main>
                <p class="miniTitle">@yield('title')</p>
                <div class="content">
                    @yield('content')
                </div>
            </main>
        </div>
        





        <div class="footer"></div>

        @yield('script')
    </body>
</html>