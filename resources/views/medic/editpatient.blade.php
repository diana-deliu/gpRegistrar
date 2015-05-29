@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        {!! Form::open(['url' => 'medic/update_patient/'.$patient['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare pacient</h3></legend>
            <div class="form-group">
                <label for="cnp" class="col-lg-2 control-label">CNP</label>

                <div class="col-lg-6">
                    {!! Form::input('number','cnp', $patient['cnp'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-lg-2 control-label">Nume</label>

                <div class="col-lg-6">
                    {!! Form::text('lastname', $patient['lastname'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-lg-2 control-label">Prenume</label>

                <div class="col-lg-6">
                    {!! Form::text('firstname', $patient['firstname'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">E-mail</label>

                <div class="col-lg-6">
                    {!! Form::email('email', $patient['email'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 control-label">Adresa</label>

                <div class="col-lg-6">
                    {!! Form::textarea('address', $patient['address'], ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
                    <a href="{{ url('medic/remove_patient').'/'.$patient['id'] }}" class="btn btn-primary pull-right">Ștergere înregistrare</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop