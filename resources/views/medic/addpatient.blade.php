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
                <label for="cnp" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">CNP</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::input('number', 'cnp', old('cnp'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Nume</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Prenume</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('firstname', old('firstname'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">E-mail</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::email('email', old('email'), ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Adresă</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'rows' => '3'])!!}
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
@stop