<?php
function getPanelState($value, $min, $max)
{
    if ($value > $min && $value < $max) {
        return "panel-success";
    }
    return "panel-primary";
}

?>
@extends('layouts.master')

@section('content')

    @include('partials.patient_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare consultaţie</h3></legend>
        <div class="row">
            <div class="form-group">
                <div class="panel panel-default col-lg-2 col-xs-offset-1 col-lg-offset-1">
                    <div class="panel-body">
                        CNP: {{ $patient['cnp'] }} <br/>
                        Nume: {{ $patient['firstname'] }} {{ $patient['lastname'] }} <br/>
                        Data nașterii: {{ $patient['birthDate'] }}
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-lg-2 col-xs-offset-1 col-lg-offset-6">
                <div class="panel-body">
                    <span>Valorile afișate cu: </span><br/>
                    <span class="text-success"><strong>verde</strong> se află în limitele normale,</span><br/>
                    <span class="text-danger"><strong>roșu</strong> sugerează o anomalie! </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată consultație</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['date'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Înălțime</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['height'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Greutate</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['weight'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Circumferință abdominală</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['abdominal_circumference'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($consult['blood_pressure'], 100, 130) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tensiune</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['blood_pressure'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($consult['glucose'], 78, 120) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Glicemie</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['glucose'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <legend><h3>Următoarea consultație</h3></legend>
        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată consultație viitoare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $consult['next_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-lg-3 col-xs-offset-1 col-lg-offset-5">
                <div class="panel-body">
                    <p>Dacă nu vă prezentaţi la consultaţie pe data respectivă,
                        aceasta
                        se va reprograma automat
                        o săptămână mai târziu!</p>
                </div>
            </div>
        </div>
    </div>

@stop
