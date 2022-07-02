<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image:url('https://cdn.dribbble.com/users/1655663/screenshots/6389755/brknstw_mmh-pattern-dribbble.png')">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand collectionBook" href="{{ url('/welcome') }}" style="color: white">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> 

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="back">
                        <div class="this-nav">                           
                                <nav>
                                    <a class ="this-nav-a collectionBook">Pick a book!</a>
                                    <a class ="this-nav-a" href="{{ url('/library') }}">The library</a>
                                    <a class ="this-nav-a collection">My collection</a>   
                                    <a class ="this-nav-a" href="{{ url('/friendship') }}">Friends</a>                                 
                                </nav>                            
                        </div>       
                    </div>
                    <ul class="navbar-nav me-auto">
                        
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class ="this-nav-a" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre  style="color: white">
                                   Hello, {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown2">
                                    <a>
                                        {{__('My books')}}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="/js/laroute.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var getLoggedUserUrl = laroute.route('getLoggedUser');
        $( document ).ready(function() {
            axios({
                method: 'get',
                url: getLoggedUserUrl
            }).then(function(response) {
                if(response)
                {
                    var homeUrl = "{{ url('/home/id') }}"; 
                    var reponseUser = response.data.id;
                    homeUrl = homeUrl.replace("id", reponseUser);
                    $(".collection").attr("href", homeUrl);
                }
            });
        });
        var getRandomBook = laroute.route('getRandomBook');
        $( document ).ready(function() {
            axios({
                method: 'get',
                url: getRandomBook
            }).then(function(response) {
                if(response)
                {
                    var swipeUrl = "{{ url('/swipe/id') }}"; 
                    var reponseBook = response.data;
                    swipeUrl = swipeUrl.replace("id", reponseBook);
                    $(".collectionBook").attr("href", swipeUrl);
                }
            });
        });
    
    </script>
   
    @yield('js')
</body>
</html>
