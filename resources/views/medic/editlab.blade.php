@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/update_lab/'.$lab['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare analize</h3></legend>
            <div class="form-group">

                <div class="panel panel-default col-lg-3 col-md-offset-1">
                    <div class="panel-body">
                        <a href="#" class="btn btn-primary btn-xs pull-right" id="patient_change_btn">
                            Pacient</a>
                        CNP: <span id="patient_cnp">
                                {{ $patient['cnp'] }}
                            </span><br/>
                        Nume: <span id="patient_name">
                                {{ $patient['firstname'] }} {{ $patient['lastname'] }}
                            </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-lg-2 control-label">Dată</label>

                <div class="col-lg-2">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker11'>
                                    {!! Form::text('date', $lab['date'], ['class' => 'form-control'])!!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::hidden('patient_id', $lab['id']) !!}
            <div class="form-group">
                <label for="hemoglobin" class="col-lg-2 control-label">Hemoglobină</label>

                <div class="col-lg-2">
                    {!! Form::text('hemoglobin', $lab['hemoglobin'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="vsh" class="col-lg-2 control-label">VSH</label>

                <div class="col-lg-2">
                    {!! Form::text('vsh', $lab['vsh'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="transaminases" class="col-lg-2 control-label">Transaminaze</label>

                <div class="col-lg-2">
                    {!! Form::text('transaminases', $lab['transaminases'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cholesterol" class="col-lg-2 control-label">Colesterol</label>

                <div class="col-lg-2">
                    {!! Form::text('cholesterol', $lab['cholesterol'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="triglycerides" class="col-lg-2 control-label">Trigliceride</label>

                <div class="col-lg-2">
                    {!! Form::text('triglycerides', $lab['triglycerides'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="creatinine" class="col-lg-2 control-label">Creatinină</label>

                <div class="col-lg-2">
                    {!! Form::text('creatinine', $lab['creatinine'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="triglycerides" class="col-lg-2 control-label">Trigliceride</label>

                <div class="col-lg-2">
                    {!! Form::text('triglycerides', $lab['triglycerides'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urea" class="col-lg-2 control-label">Uree</label>

                <div class="col-lg-2">
                    {!! Form::text('urea', $lab['urea'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urine" class="col-lg-2 control-label">Examen de urină</label>

                <div class="col-lg-2">
                    {!! Form::text('urine', $lab['urine'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="copro" class="col-lg-2 control-label">Examen de coproparazitologic</label>

                <div class="col-lg-2">
                    {!! Form::text('copro', $lab['copro'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-2 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Editare</button>
                    <a href="{{ url('medic/remove_lab').'/'.$lab['id'] }}" class="btn btn-primary pull-right">Ștergere</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
    <div class="modal" id="patient_change">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Alegere pacienți</h4>
                </div>

                <div class="modal-body">
                    <select class="form-control" id="patients_dropdown"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="patient_choose">Alegere</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    @include('partials.date_picker')
    @include('partials.patients_dropdown')
@stop