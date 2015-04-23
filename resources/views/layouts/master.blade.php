<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Poiret+One|Open+Sans:400,700&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/white.css') }}"/>
    <title>SimfoMed - Medicină de familie</title>
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="logo-box">
            <a href="{{ url('/') }}" class="logo-text">
                <span><a href="{{ url('/') }}" title="SimfoMed" class="logo">
                        <img src="{{ asset('images/heart_final_100.png') }}"/>
                    </a></span>
            </a>
        </div>
        <div class="logo-textbox">
            <a href="{{ url('/') }}">
                <p>SimfoMed</p>
            </a>
        </div>
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li>Bine ai venit, {{ Auth::user()->name }} </li>
                    @else
                        <li>
                            <a href="{{ url('/auth/login') }}"><span>Autentificare</span></a>
                        </li>
                        <li>
                            <a href="{{ url('/auth/register') }}"><span>Înregistrare</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@yield('content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>