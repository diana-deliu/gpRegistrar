<?php
function getPanelState($value, $min, $max)
{
    if ($value >= $min && $value <= $max) {
        return "panel-success";
    }
    return "panel-primary";
}

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

    @include('partials.patient_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare analize</h3></legend>
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
            <div class="panel-body">
                <div class="panel panel-default col-lg-2 col-xs-offset-1 col-lg-offset-6">
                    <div class="panel-body">
                         <span>Valorile afișate cu: </span><br/>
                        <span class="text-success"><strong>verde</strong> se află în limitele normale,</span><br/>
                        <span class="text-danger"><strong>roșu</strong> sugerează o anomalie! </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['hemoglobin'], 13, 18) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hemoglobină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['hemoglobin']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['vsh'], 1, 20) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">VSH</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['vsh']) }}</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['transaminases'], 5, 56) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Transaminaze</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['transaminases']) }}</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['cholesterol'], 0, 130) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Colesterol</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['cholesterol']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel {{ getPanelState($lab['triglycerides'], 0, 100) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trigliceride</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['triglycerides']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['creatinine'], 0, 43) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Creatinină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['creatinine']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['urea'], 0, 6) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Uree</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['urea']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['urine'], 4.8, 7.4) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Examen de urină</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['urine']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel {{ getPanelState($lab['copro'], 0, 1000) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Examen coproparazitologic</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ checkIfSet($lab['copro']) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <legend><h3>Următoarele analize</h3></legend>
        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată analize viitoare</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $lab['next_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default col-lg-3 col-xs-offset-1 col-lg-offset-5">
                <div class="panel-body">
                    <p>Dacă nu vă prezentaţi la analize pe data respectivă,
                            acestea
                            se vor reprograma automat
                            o săptămână mai târziu!</p>

                </div>
            </div>
        </div>
        </div>
    </div>

@stop
