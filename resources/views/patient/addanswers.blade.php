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

    @include('partials.patient_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare chestionar</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
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
        </div>
        {!! Form::open(['url' => 'patient/create_answers/'.$survey['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            @foreach($survey['questions'] as $question)
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Întrebarea {{ $question['question_id'] }}
                                    . {{$question['question']}}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-1">
                                        <?php $isEdit = false; ?>
                                        @if(isset($answers[$question['id']]) && $answers[$question['id']])
                                            {!! Form::text('answer'.$question['id'], $answers[$question['id']], ['class' => 'form-control'])!!}
                                            <?php $isEdit = true; ?>
                                        @else
                                            {!! Form::text('answer'.$question['id'], old('answer'.$question['id']), ['class' => 'form-control'])!!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-1">
                    @if($isEdit)
                        <button type="submit" class="btn btn-warning">Editare</button>
                    @else
                        <button type="submit" class="btn btn-success">Adăugare</button>
                    @endif
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop
