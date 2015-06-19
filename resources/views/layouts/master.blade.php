<!DOCTYPE html>
<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700|Open+Sans:400,300,700&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/white.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/noty.manager.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/simpleeventcalendar.css') }}"/>
    {{--
        <link rel="stylesheet" href="{{ asset('css/pnotify.custom.min.css') }}"/>
    --}}
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="{{ asset('js/lava.js') }}"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-96x96.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="shortcut icon" href="{{ asset('favicon_images/favicon.ico') }}"
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<main class="page-content content-wrap">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo-text">
                <span><a href="{{ url('/') }}" title="GPRegistrar" class="logo">
                        <img src="{{ asset('images/heart_final_100.png') }}"/>
                    </a></span>
                </a>
            </div>
            <div class="logo-textbox-wrapper">
                <div class="logo-textbox">
                    <a href="{{ url('/') }}">
                        <p><strong>gp</strong>Registrar</p>
                    </a>
                </div>
            </div>
            <div class="topmenu-outer">
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            @if (Auth::user()->role !== 'admin')
                                @if(Auth::user()->role === 'medic')
                                    <li class="user"><a href=" {{ url('medic/account_details') }}"><span
                                                    class="glyphicon glyphicon-user"></span></a></li>
                                @endif
                                @if(Auth::user()->role === 'patient')
                                    <li class="user"><a href=" {{ url('patient/account_details') }}"><span
                                                    class="glyphicon glyphicon-user"></span></a></li>
                                @endif
                                <li class="notification">
                                    <a href="#" id="open_calendar" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button"><span class="glyphicon glyphicon-calendar"></span></a>

                                    <div class="dropdown-menu" id="calendar-dropdown" role="menu" aria-labelledby="open_calendar">

                                        <div class="panel">
                                            <header class="panel-heading">
                                                <strong>Calendar</strong>
                                            </header>
                                            <div class="panel-body">
                                            <div id="calendar">
                                                <div class="calendar-container">
                                                    <div class="calendar">
                                                        <header>
                                                            <h4 class="month"></h4>
                                                            <a class="btn-prev glyphicon glyphicon-chevron-left" href="#"></a>
                                                            <a class="btn-next glyphicon glyphicon-chevron-right" href="#"></a>
                                                        </header>
                                                        <table>
                                                            <thead class="event-days">
                                                            <tr></tr>
                                                            </thead>
                                                            <tbody class="event-calendar">
                                                            <tr class="1"></tr>
                                                            <tr class="2"></tr>
                                                            <tr class="3"></tr>
                                                            <tr class="4"></tr>
                                                            <tr class="5"></tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                            <div id="events-container">
                                                <ul id="events" class="list-group">
                                                </ul>
                                            </div>
                                            </div>
                                        </div>


                                    </div>
                                </li>
                                <li class="notification">
                                    <a href="#" id="notifications" role="button" id="drop3" lass="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-globe"></span></a>

                                    <div id="notification-container" class="dropdown-menu" role="menu" aria-labelledby="drop3">

                                        <section class="panel">
                                            <header class="panel-heading">
                                                @if(Auth::user()->role === 'medic')
                                                    <strong>Astăzi</strong>

                                                @elseif(Auth::user()->role === 'patient')
                                                    <strong>Următoarea săptămână</strong>

                                                @endif
                                            </header>
                                            <div id="notification-list" class="list-group list-group-alt">
                                            </div>
                                            <footer class="panel-footer">
                                            </footer>
                                        </section>

                                    </div>
                                </li>
                            @endif

                            <li class="welcome-right"><strong>{{ Auth::user()->email }}</strong></li>
                            <li>
                                <a href="{{ url('/auth/logout') }}"><span>Logout</span></a>
                            </li>
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
</main>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
{{--
<script src="{{ asset('js/pnotify.custom.min.js') }}"></script>
--}}
<script src="{{ asset('js/collapse.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="{{ asset('js/transition.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('js/jquery.noty.manager.js') }}"></script>
<script src="{{ asset('js/simplecalendar.js') }}"></script>
@include('partials.calendar_script')
@include('partials.notification_script')
@include('partials.filter_script')
@yield('footer_scripts')
</body>
</html>