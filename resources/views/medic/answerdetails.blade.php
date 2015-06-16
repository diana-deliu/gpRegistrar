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
        <legend><h3>Vizualizare chestionar</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Titlu</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $survey['title'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată de început</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $survey['start_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată de sfârșit</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $survey['end_date'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        @foreach($survey['questions'] as $question)
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Întrebarea {{ $question['question_id'] }}
                                . {{$question['question']}}</h3>
                        </div>
                        <div class="panel-body">
                            <p>{{ $answers[$question['id']] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop
