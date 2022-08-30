<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} @yield('title')</title>

    <!-- Font Awesome - load everything-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="{{ asset('css/ssi.css') }}" rel="stylesheet">
    @yield('custom_js_head')

    <style media="screen">
        .navbar-custom {
            background-color:
                @switch(App::environment()) 
                    @case('local') #CE9DD9; @break 
                    @case('testing') #B5EAD7; @break 
                    @case('production') #4FB7DE; @break 
                @endswitch
        }
    </style>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fas fa-ship"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
               
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('examenes.logout') }}">Cerrar Sesión</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
        
            @foreach (['danger', 'warning', 'success', 'info'] as $key)
                @if(session()->has($key))
                <div class="alert alert-{{ $key }} alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session()->get($key) !!}
                </div>
                @endif
            @endforeach            
            
            @yield('content')
            
        
        </main>
    </div>
    @auth
    <div id="watermark">{{ Auth::id() }}</div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ asset('js/principal.js') }}"></script>
    @yield('custom_js')
</body>

</html>
