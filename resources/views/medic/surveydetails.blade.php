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
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dată de început</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $survey['start_date'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
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
        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Titlu chestionar</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $survey['title'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        @foreach($survey['questions'] as $question)
            <div class="row">
                <div class="col-lg-2 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Întrebarea {{ $question['question_id'] }}</h3>
                        </div>
                        <div class="panel-body">
                            <p>{{ $question['question'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <div class="col-lg-4 col-xs-offset-1">
                <a href="{{ url('medic/edit_survey').'/'.$survey['id'] }}" class="btn btn-warning">Editare</a>
                <a href="{{ url('medic/view_answers').'/'.$survey['id'] }}" class="btn btn-default pull-right">Vezi
                    răspunsuri</a>
            </div>
        </div>
    </div>

@stop
