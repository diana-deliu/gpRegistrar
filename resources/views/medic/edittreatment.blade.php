@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::model($treatment, ['url' => 'medic/update_treatment/'.$treatment['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare recomandare</h3></legend>
            <div class="form-group">

                <div class="panel panel-default col-lg-7 col-xs-10 col-lg-offset-1 col-xs-offset-1">
                    <div class="panel-body">
                        <a href="#" class="btn btn-success btn-xs pull-right" id="patient_change_btn">
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
                <label for="date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată recomandare</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
                                    {!! Form::text('date', $treatment['date'], ['class' => 'form-control'])!!}
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
            {!! Form::hidden('patient_id', $patient['id']) !!}
            <div class="form-group">
                <label for="diagnosis" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Diagnostic</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::select('diagnosis', $diagnosis, null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="treatment" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Tratament</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::select('treatment', $treatments, null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="extra" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Specificații</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::textarea('extra', $treatment['extra'], ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="referral" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Trimitere</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::textarea('referral', $treatment['referral'], ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
                    <a href="{{ url('medic/remove_treatment').'/'.$treatment['id'] }}" class="btn btn-primary pull-right">Ștergere</a>
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
                    <button type="button" class="btn btn-default" id="patient_choose">Alegere</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    @include('partials.date_picker')
    @include('partials.patients_dropdown')
@stop