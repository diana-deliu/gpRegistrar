@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        {!! Form::open(['url' => 'medic/create_consult/'.$patient['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare consultaţie</h3></legend>
            <div class="form-group">
                <label for="cnp" class="col-lg-2 control-label">Pacient</label>

                <div class="panel panel-default col-lg-6">
                    <div class="panel-body">
                        <a href="#" class="btn btn-warning btn-xs pull-right">Schimbă pacient</a>
                        CNP: {{ $patient['cnp'] }} <br/>
                        Nume: {{ $patient['firstname'] }} {{ $patient['lastname'] }}
                    </div>
                </div>
            </div>
            {!! Form::hidden('patient_id', $patient['id']) !!}
            <div class="form-group">
                <label for="firstname" class="col-lg-2 control-label">Data</label>

                <div class="col-lg-6">
                    <div class="container">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker11'>
                                    <input type='text' class="form-control"/>
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
                <label for="height" class="col-lg-2 control-label">Înălţime [cm]</label>

                <div class="col-lg-6">
                    {!! Form::text('height', null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="weight" class="col-lg-2 control-label">Greutate [kg]</label>

                <div class="col-lg-6">
                    {!! Form::text('weight', null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="abdominal_circumference" class="col-lg-2 control-label">Circumferinţă abdominală [cm]</label>

                <div class="col-lg-6">
                    {!! Form::text('abdominal_circumference', null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="blood_pressure" class="col-lg-2 control-label">Tensiune [mm/Hg]</label>

                <div class="col-lg-6">
                    {!! Form::text('blood_pressure', null, ['class' => 'form-control'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="glucose" class="col-lg-2 control-label">Glicemie</label>

                <div class="col-lg-6">
                    {!! Form::text('glucose', null, ['class' => 'form-control'])!!}
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
@stop
@section('footer_scripts')
    @include('partials.date_picker')
@stop
