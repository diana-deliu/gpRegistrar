@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::model($vaccine, ['url' => 'medic/update_vaccine/'.$vaccine['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare vaccinare</h3></legend>
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
                <label for="start_date" class="col-lg-2 control-label">Dată de început</label>

                <div class="col-lg-2">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class='input-group date' class="datetimepicker">
                                    {!! Form::text('start_date', $vaccine['start_date'], ['class' => 'form-control'])!!}
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
                <label for="category" class="col-lg-2 control-label">Categorie</label>

                <div class="col-lg-2">
                    {!! Form::select('category', $categories, null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="interval" class="col-lg-2 control-label">Interval [luni]</label>

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
                <div class="col-lg-2 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Editare</button>
                    <a href="{{ url('medic/remove_vaccine').'/'.$vaccine['id'] }}" class="btn btn-primary pull-right">Ștergere</a>
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