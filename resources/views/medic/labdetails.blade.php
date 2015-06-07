@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare analize</h3></legend>
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
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată analize</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hemoglobină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['hemoglobin'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">VSH</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['vsh'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transaminaze</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['transaminases'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Colesterol</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['cholesterol'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trigliceride</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['triglycerides'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Creatinină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['creatinine'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Uree</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['urea'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Examen de urină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['urine'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Examen coproparazitologic</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['copro'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-1">
                <a href="{{ url('medic/edit_lab').'/'.$lab['id'] }}" class="btn btn-warning">Editare</a>
            </div>
        </div>
    </div>

@stop
