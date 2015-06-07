@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare consultaţie</h3></legend>
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
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată consultație</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Înălțime</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['height'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Greutate</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['weight'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Circumferință abdominală</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['abdominal_circumference'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tensiune</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['blood_pressure'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Glicemie</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['glucose'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-1">
                <a href="{{ url('medic/edit_consult').'/'.$consult['id'] }}" class="btn btn-warning">Editare</a>
            </div>
        </div>
    </div>

@stop
