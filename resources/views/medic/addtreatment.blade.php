@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_treatment', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare recomandare</h3></legend>
            <div class="form-group">
                <div class="panel panel-default col-lg-7 col-xs-10 col-lg-offset-1 col-xs-offset-1">
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
                <label for="date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată recomandare</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
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
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content='Se va completa cu numărul de tablete/picături pe zi, precum și recomandări, spre exemplu "înainte de masă", exact ca pe rețetă.' data-original-title="" title="">Info</button>


                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::textarea('extra', old('extra'), ['class' => 'form-control', 'rows' => '5'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="referral" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Trimitere</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content='Se va specifica secția și motivul/id-ul și data analizelor/consultației pe baza cărora s-a considerat necesară trimiterea' data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::textarea('referral', old('referral'), ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
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
    @include('partials.popover')
@stop
