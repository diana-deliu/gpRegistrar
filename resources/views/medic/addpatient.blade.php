@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_patient', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Adăugare pacient</h3></legend>
            <div class="form-group">
                <label for="cnp" class="col-lg-2 control-label">CNP</label>

                <div class="col-lg-2">
                    {!! Form::input('number', 'cnp', old('cnp'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-lg-2 control-label">Nume</label>

                <div class="col-lg-2">
                    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-lg-2 control-label">Prenume</label>

                <div class="col-lg-2">
                    {!! Form::text('firstname', old('firstname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">E-mail</label>

                <div class="col-lg-2">
                    {!! Form::email('email', old('email'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Parolă</label>

                <div class="col-lg-2">
                    {!! Form::password('password', ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-lg-2 control-label">Confirmare parolă</label>

                <div class="col-lg-2">
                    {!! Form::password('password_confirmation', ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Adresă</label>

                <div class="col-lg-2">
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-2 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Adăugare</button>
                    <a href="{{ url ('medic/import_patient') }}" class="btn btn-primary pull-right"> Import Excel</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop