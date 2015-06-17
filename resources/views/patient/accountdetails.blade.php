@extends('layouts.master')

@section('content')

    @include('partials.patient_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Contul meu</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['lastname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prenume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['firstname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['user']['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adresa</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['address'] }}</p></div>
                </div>
            </div>
        </div>
        {!! Form::open(['url' => 'patient/edit_password', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <div class="row">
                <div class="col-xs-6 col-sm-2 col-md-offset-1">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Parolă nouă</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off'])!!}
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-2">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Confirmare parolă nouă</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-1">
                    <button type="submit" class="btn btn-warning ">Modificare parolă</button>
                </div>
            </div>
            {!! Form::close() !!}
        </fieldset>
    </div>

@stop
