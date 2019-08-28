<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="icon" href="{{ asset('img/icon.ico') }}"/>

        <!-- Fonts -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- JS -->
        <script src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{ asset('js/jquery-ui.min.js')}}"></script>

        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        

    

    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">

        <!-- Image Logo -->

        <a class="navbar-brand logo-image" href="/"><img src="{{ asset('img/logo_white.svg') }}" alt="appointy logo"></a> 

        <!-- Mobile Menu Toggle Button -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>

        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll {{ (Route::currentRouteName() == 'index') ? 'currentlink' : '' }}" href="{{ route('index') }}">HOME</a>
                </li>

                

                @if(session()->has('logged_in'))
                    <li class="nav-item">
                        <a class="nav-link page-scroll {{ (Route::currentRouteName() == 'appointments') ? 'currentlink' : '' }}" href="{{ route('appointments') }}">AFSPRAKEN</a>
                    </li>

                    @if(session()->get('account_type') == 'klant')
                        <li class="nav-item">
                            <a class="nav-link page-scroll {{ (Route::currentRouteName() == 'bookmarks') ? 'currentlink' : '' }}" href="{{ route('bookmarks') }}">FAVORIETEN</a>
                        </li>
                    @endif

                    <!-- Dropdown Menu -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle page-scroll {{ (Route::currentRouteName() == 'account') ? 'currentlink' : '' }}" href="{{ route('account') }}" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">ACCOUNT</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('account') }}"><span class="item-text">PROFIEL</span></a>
                            <div class="dropdown-items-divide-hr"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><span class="item-text">UITLOGGEN</span></a>
                        </div>
                    </li>

                    <!-- end of dropdown menu -->

                @else
                    <li class="nav-item">
                        <a class="nav-link page-scroll {{ (Route::currentRouteName() == 'login') ? 'currentlink' : '' }}" href="{{ route('login') }}">INLOGGEN</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll {{ (strpos(Route::currentRouteName(), 'register') !== false) ? 'currentlink' : '' }}" href="{{ route('register') }}">REGISTREREN</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    


      

        <main>
            <div id="fadeout">
                <div class="messages">
                    @if(session()->has('message'))
                        <div class="message"><p>{{ session()->get('message') }}</p></div>
                    @endif
                    
                    @if(session()->has('error'))
                        <div class="error"><p>{{ session()->get('error') }}</p></div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="error"><p>{{ $errors->first() }}</p></div>
                    @endif
                </div>
            </div>
            
            <div class="container">
                @yield('content')
            </div>
        </main>

        




        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <!-- <script src="{{ asset('js/script.js') }}"></script> -->
        <script src="{{ asset('js/validator.min.js') }}"></script>



        @yield('script')

        <script>
            window.onload = function() {
                window.setTimeout(fadeout, 8000); //8 seconds
            }

            function fadeout() {
                document.getElementById('fadeout').style.opacity = '0';
            }

            $(window).on('scroll load', function() {
		if ($(".navbar").offset().top > 20) {
			$(".fixed-top").addClass("top-nav-collapse");
		} else {
			$(".fixed-top").removeClass("top-nav-collapse");
		}
    });
/*
            $(document).ready(function(){
                $(window).scroll(function(){
                    var scroll = $(window).scrollTop();
                    if (scroll > 10) {
                        $("nav").addClass("collapsed-nav");
                    } else{
                        $("nav").removeClass("collapsed-nav");  	
                    }
                })
            })*/
        </script>
    </body>
</html>