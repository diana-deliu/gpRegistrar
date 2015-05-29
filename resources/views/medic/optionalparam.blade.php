@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        {!! Form::open(['url' => 'medic/create_patient', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Configurare parametri</h3></legend>
            <div class="form-group">
                <label for="parametru" class="col-lg-2 control-label">Parametru</label>

                <div class="col-lg-6">
                    {!! Form::text('parameter', old('cnp'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-lg-2 control-label">Nume</label>

                <div class="col-lg-6">
                    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-lg-2 control-label">Prenume</label>

                <div class="col-lg-6">
                    {!! Form::text('firstname', old('firstname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">E-mail</label>

                <div class="col-lg-6">
                    {!! Form::email('email', old('email'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Parolă</label>

                <div class="col-lg-6">
                    {!! Form::password('password', ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-lg-2 control-label">Confirmare parolă</label>

                <div class="col-lg-6">
                    {!! Form::password('password_confirmation', ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Adresă</label>

                <div class="col-lg-6">
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <a href="#" class="btn btn-primary">Adăugare parametri</a>
                    <a href="#" class="btn btn-warning pull-right">Editare parametri</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

    </div>
@stop