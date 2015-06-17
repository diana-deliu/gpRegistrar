@extends('layouts.master')

@section('content')

    @include('partials.patient_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare vaccinare</h3></legend>
        <div class="row">
            <div class="form-group">
                <div class="panel panel-default col-lg-3 col-md-offset-1">
                    <div class="panel-body">
                        CNP: {{ $patient['cnp'] }} <br/>
                        Nume: {{ $patient['firstname'] }} {{ $patient['lastname'] }} <br/>
                        Data nașterii: {{ $patient['birthDate'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată vaccinare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Categorie</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['category'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Notificare către pacient</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['notification'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Setare programare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['appointment'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <legend><h3>Următoarea vaccinare</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată vaccinare viitoare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['next_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Categorie</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['category'] }}</p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-lg-3 col-md-offset-1">
                <div class="panel-body">
                    <p>Dacă pacientul nu se prezintă la vaccinare la data respectivă,
                            aceasta
                            se va reprograma automat
                            o săptămână mai târziu!</p>

                </div>
            </div>
        </div>
        </div>
    </div>

@stop
