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
        <legend><h3>Fișă medicală</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Medic</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['medic']['firstname'] }} {{ $patient['medic']['lastname'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">CNP</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['cnp'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['lastname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prenume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['firstname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data naşterii</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['birthDate'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vârsta</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['age'] }}</p></div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sex</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['sex'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adresa</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['address'] }}</p></div>
                </div>
            </div>
        </div>

        <legend><h3>Ultima consultație</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Înălțime [cm]</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['last_consult']['height'] }}</p></div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Greutate [kg]</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['last_consult']['weight'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Circumferință abdominală [cm]</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['last_consult']['abdominal_circumference'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-sm-2">
                <div class="panel {{ getPanelState($patient['last_consult']['blood_pressure'], 7, 11) }}">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tensiune [mm/Hg]</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['last_consult']['blood_pressure'] }}</p></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default col-lg-2 col-lg-offset-1">
                <div class="panel-body">
                    <strong>NOTĂ:</strong>
                    <p>Valorile afișate cu: </p>
                    <p class="text-success"><strong>verde</strong> se află în limitele normale,</p>
                    <p class="text-danger"><strong>roșu</strong> sugerează o anomalie! </p>
                </div>
            </div>
        </div>

        <legend><h3>Curba sănătății</h3></legend>
        <div class="row">
            <div class="panel panel-default col-lg-6 col-lg-offset-1">
                <div class="panel-body">
                    <strong>NOTĂ:</strong>
                    <p>blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla
                        blablablablablablablablablablablablablablablablablablablablablablablablablablablabla
                        blablablablablablablablablablablablablablablablablablablablablablablabla
                        blablablablablablablablablablablablablablablablablablablabla
                        blablablablablablablablablablablablablablablablablablablablablablablabla</p>
                </div>
            </div>
        </div>
    </div>

@stop