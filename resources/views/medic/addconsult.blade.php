@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_consult', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare consultaţie</h3></legend>
            <div class="form-group">
                <div class="panel panel-default col-xs-4 col-md-offset-1">
                    <div class="panel-body">
                        <a href="#" class="btn btn-success btn-xs pull-right" id="patient_change_btn">
                            Pacient</a>
                        CNP: <span id="patient_cnp">
                            @if(isset($patient))
                                {{ $patient['cnp'] }}
                            @endif
                            </span><br/>
                        Nume: <span id="patient_name">
                                @if(isset($patient))
                                    {{ $patient['firstname'] }} {{ $patient['lastname'] }}
                                @endif
                            </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-lg-2 control-label">Dată</label>

                <div class="col-lg-6">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
                                    {!! Form::text('date', old('date'), ['class' => 'form-control'])!!}
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
            @if(isset($patient))
                {!! Form::hidden('patient_id', $patient['id']) !!}
            @else
                {!! Form::hidden('patient_id', null, ['id'=>'patient_id_hidden']) !!}
            @endif
            <div class="form-group">
                <label for="height" class="col-lg-2 control-label">Înălţime [cm]</label>

                <div class="col-lg-2">
                    {!! Form::text('height', old('height'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="weight" class="col-lg-2 control-label">Greutate [kg]</label>

                <div class="col-lg-2">
                    {!! Form::text('weight', old('weight'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="abdominal_circumference" class="col-lg-2 control-label">Circumferinţă abdominală
                    [cm]</label>

                <div class="col-lg-2">
                    {!! Form::text('abdominal_circumference', null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="blood_pressure" class="col-lg-2 control-label">Tensiune [mm/Hg]</label>

                <div class="col-lg-2">
                    {!! Form::text('blood_pressure', old('blood_pressure'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="glucose" class="col-lg-2 control-label">Glicemie</label>

                <div class="col-lg-2">
                    {!! Form::text('glucose', old('glucose'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6 col-xs-offset-2">
                    <button type="submit" class="btn btn-default">Adăugare</button>
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
