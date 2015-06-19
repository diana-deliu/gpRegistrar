@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/import_patient', 'class' => 'form-horizontal', 'files' => true]) !!}
        <fieldset>
            <legend><h3>Import Excel</h3></legend>
            <div class="row">
                <div class="panel panel-default col-lg-5 col-xs-9 col-lg-offset-1 col-xs-offset-1">
                    <div class="panel-body">
                        <p>Se acceptă numai fişiere în format <strong>Excel</strong> cu extensiile <strong>.xls</strong>
                            şi
                            <strong>.xlsx</strong>, având următoarele coloane, în următoarea ordine:</p><br/>

                        <div class="restriction-list">
                            <ul>
                                <li type="none"><strong>CNP | </strong></li>
                                <li type="none"><strong>Prenume | </strong></li>
                                <li type="none"><strong>Nume | </strong></li>
                                <li type="none"><strong>Adresă | </strong></li>
                                <li type="none"><strong>E-mail</strong></li>
                            </ul>
                            <br/>

                            <p>fără a specifica titlurile coloanelor în fişier.</p>

                            <p class="text-danger"> Dimensiunea maximă este a fişierului ales este de
                                <strong>{{ $maxFileSize }} MB</strong> !</p>
                            </ul>
                        </div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="file" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Alegere fişier</label>

                    <div class="col-lg-4 col-xs-10 col-sm-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-0">
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

    </div>
    </div>
@stop