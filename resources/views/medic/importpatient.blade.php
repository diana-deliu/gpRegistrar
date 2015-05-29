@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        {!! Form::open(['url' => 'medic/import_patient', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Se acceptă numai fişiere în format <strong>Excel</strong> cu extensiile <strong>.xls</strong> şi <strong>.xlsx</strong>, având următoarele coloane, în următoarea ordine:</p><br/>

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
                        <p class="text-danger"> Dimensiunea maximă este a fişierului ales este de <strong>{{ $maxFileSize }} MB</strong> !</p>
                        </ul>
                    </div>
                </div>
            </div>
            <legend><h3>Import Excel</h3></legend>
            <div class="form-group">
                <label for="file" class="col-lg-2 control-label">Alegere fişier</label>

                <div class="col-lg-6">
                    {!! Form::file('file', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Import</button>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

    </div>
    </div>
@stop