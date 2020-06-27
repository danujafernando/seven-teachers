<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sevent teachers - Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #main-tabs.nav-tabs .nav-item{
            background-color: #a0a0a0;
            margin-left: 2px;
            border: 5px 5px 0 0;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            color: white;
            width: 170px;
        }
        #main-tabs.nav-tabs .nav-item a{
            color: white;
            text-align: center;
        }
        #main-tabs.nav-tabs .nav-link.active {
            color: white;
            background-color: #000000;
            border-color: #dee2e6 #dee2e6 #000000;
        }
        #sub-tabs.nav-tabs .nav-item{
            background-color: #0273ffc9;
            margin: 2px;
            border: 5px 5px 0 0;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            color: white;
        }
        #sub-tabs.nav-tabs .nav-item a{
            color: white;
        }
        #sub-tabs.nav-tabs .nav-link.active {
            color: white;
            background-color: #0a6be4; 
            border-color: #dee2e6 #dee2e6 #f5f8fa;
        }
        .primary-color {
            border-color: #953d94; 
            background: #953d94; 
            color: #ffffff;
        }
        .primary-color:hover {
            border-color: #953d94; 
            background: #953d94; 
            color: #ffffff;
        }
        .btn-width{
            width: 150px;
        } 
        #note{
            list-style: none;
            padding: 0;
        }
        #note li::before{
            content: "*";
            color: red;
            font-weight: bold;
            display: inline-block;
            font-size: 16px;
            margin-right: 3px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 200px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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
</body>
</html>
