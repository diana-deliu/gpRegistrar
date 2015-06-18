@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
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
                        <p>{{ $medic['lastname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prenume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $medic['firstname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $medic['user']['email'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cod medic</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $medic['doc_code'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cabinet</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $medic['practice'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adresa</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $medic['address'] }}</p></div>
                </div>
            </div>
        </div>
        {!! Form::open(['url' => 'medic/edit_password', 'class' => 'form-horizontal']) !!}
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
