@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
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
            <div class="col-xs-6 col-sm-3 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată vaccinare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['start_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Categorie</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['category'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Interval</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['interval'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Notificare către pacient</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $vaccine['notification'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
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

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-1">
                <a href="{{ url('medic/edit_vaccine').'/'.$vaccine['id'] }}" class="btn btn-warning">Editare</a>
            </div>
        </div>
    </div>

@stop
