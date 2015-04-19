<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <title>MedImpuls - Medicină de familie</title>
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="logo-box">
            <a href="{{ url('/') }}" class="logo-text">
                <span>MedImpuls</span>
            </a>
        </div>
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
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