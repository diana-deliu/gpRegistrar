@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_lab', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare analize</h3></legend>
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
                <label for="hemoglobin" class="col-lg-2 control-label">Hemoglobină</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('hemoglobin', old('hemoglobin'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="vsh" class="col-lg-2 control-label">VSH</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 50 si 100." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('vsh', old('vsh'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="transaminases" class="col-lg-2 control-label">Transaminaze</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('transaminases', old('transaminases'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="abdominal_circumference" class="col-lg-2 control-label">Colesterol</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('cholesterol', old('cholesterol'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="triglycerides" class="col-lg-2 control-label">Trigliceride</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('triglycerides', old('triglycerides'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="creatinine" class="col-lg-2 control-label">Creatinină</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('creatinine', old('creatinine'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urea" class="col-lg-2 control-label">Uree</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('urea', old('urea'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="urine" class="col-lg-2 control-label">Examen de urină</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="left" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('urine', old('urine'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="copro" class="col-lg-2 control-label">Examen coproparazitologic</label>
                <button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="right" data-content="Valorile normale sunt cuprinse intre 10 si 50." data-original-title="" title="">Info</button>

                <div class="col-lg-2">
                    {!! Form::text('copro', old('copro'), ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Adăugare consultație</button>
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
