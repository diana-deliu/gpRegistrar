<?php
function checkIfSet($value)
{
    if (!strlen($value)) {
        return "-";
    }
    return $value;
}

?>
@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare recomandare</h3></legend>
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
                        <h3 class="panel-title">Dată</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $treatment['date'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Diagnostic</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $treatment['diagnosis'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tratament</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $treatment['treatment'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Specificaţii</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($treatment['extra']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trimitere</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($treatment['referral']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Setare programare viitoare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $treatment['appointment'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-1">
                <a href="{{ url('medic/edit_treatment').'/'.$treatment['id'] }}" class="btn btn-warning">Editare</a>
            </div>
        </div>
    </div>
@stop
