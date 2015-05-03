<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Poiret+One|Open+Sans:400,700&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/white.css') }}"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-96x96.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="shortcut icon" href="{{ asset('favicon_images/favicon.ico') }}"
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>GPRegistrar - Cea mai la îndemână aplicație pentru medici și pacienți!</title>
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="logo-box">
            <a href="{{ url('/') }}" class="logo-text">
                <span><a href="{{ url('/') }}" title="GPRegistrar" class="logo">
                        <img src="{{ asset('images/heart_final_100.png') }}"/>
                    </a></span>
            </a>
        </div>
        <div class="logo-textbox">
            <a href="{{ url('/') }}">
                <p><strong>gp</strong>Registrar</p>
                <span>Cea mai la îndemână aplicație pentru medici și pacienți!</span>
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
<div class="page-footer">
    <p><strong>gp</strong>Registrar © 2015</p>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>