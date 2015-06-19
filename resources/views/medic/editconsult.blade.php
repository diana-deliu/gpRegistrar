@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/update_consult/'.$consult['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare consultație</h3></legend>
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
                <label for="date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată consultaţie</label>

                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-7 col-sm-9 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
                                    {!! Form::text('date', $consult['date'], ['class' => 'form-control'])!!}
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
            <div class="form-group">
                <label for="next_date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată consultaţie viitoare</label>

                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-7 col-sm-9 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
                                    {!! Form::text('next_date', $consult['next_date'], ['class' => 'form-control'])!!}
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
                <label for="height" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Înălțime [cm]</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('height', $consult['height'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="weight" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Greutate [kg]</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('weight', $consult['weight'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="abdominal_circumference" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Circumferință abdominală [cm]</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('abdominal_circumference', $consult['abdominal_circumference'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="blood_pressure" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Tensiune [mm/Hg]</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('blood_pressure', $consult['blood_pressure'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="blood_pressure" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Glicemie [unităţi]</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('glucose', $consult['glucose'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
                    <a href="{{ url('medic/remove_consult').'/'.$consult['id'] }}" class="btn btn-primary pull-right">Ștergere</a>
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