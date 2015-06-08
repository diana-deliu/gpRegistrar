@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_vaccine', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare vaccinări</h3></legend>
            <div class="form-group">
                <div class="panel panel-default col-lg-4 col-md-offset-1">
                    <div class="panel-body">
                        <a href="#" class="btn btn-primary btn-xs pull-right" id="patient_change_btn">
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
                <label for="start_date" class="col-lg-2 control-label">Dată de început</label>

                <div class="col-lg-6">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker11'>
                                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control'])!!}
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
                <label for="category" class="col-lg-2 control-label">Categorie</label>

                <div class="col-lg-2">
                    {!! Form::select('category', $categories, null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="interval" class="col-lg-2 control-label">Interval [în luni]</label>

                <div class="col-lg-2">
                    {!! Form::select('interval', $intervals, null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="notification" class="col-lg-2 control-label">Notificare către pacient</label>

                <div class="col-lg-2">
                    {!! Form::checkbox('notification', old('notification'), true)!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="appointment" class="col-lg-2 control-label">Setare programare</label>

                <div class="col-lg-2">
                    {!! Form::checkbox('appointment', old('appointment'), true)!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
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
                    <button type="button" class="btn btn-primary" id="patient_choose">Alegere</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    @include('partials.date_picker')
    @include('partials.patients_dropdown')
    @include('partials.popover')
@stop
