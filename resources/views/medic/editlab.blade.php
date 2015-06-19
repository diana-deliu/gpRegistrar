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
                <label for="date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată analize</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
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
            <div class="form-group">
                <label for="next_date" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Dată analize viitoare</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-0 col-md-offset-0 col-lg-offset-0">
                    <div class="container">
                        <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                            <div class="form-group">
                                <div class="input-group date datetimepicker">
                                    {!! Form::text('next_date', $lab['next_date'], ['class' => 'form-control'])!!}
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
                <label for="hemoglobin" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Hemoglobină</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('hemoglobin', $lab['hemoglobin'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="vsh" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">VSH</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 50 si 100." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('vsh', $lab['vsh'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="transaminases" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Transaminaze</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('transaminases', $lab['transaminases'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cholesterol" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Colesterol</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('cholesterol', $lab['cholesterol'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="triglycerides" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Trigliceride</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('triglycerides', $lab['triglycerides'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="creatinine" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Creatinină</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('creatinine', $lab['creatinine'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urea" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Uree</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('urea', $lab['urea'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urine" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Examen de urină</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('urine', $lab['urine'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="copro" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Examen de coproparazitologic</label>
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                    {!! Form::text('copro', $lab['copro'], ['class' => 'form-control']) !!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
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