@extends('layouts.master')

@section('content')

    @include('partials.admin_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'admin/update_medic/'.$medic['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare medic</h3></legend>
            <div class="form-group">
                <label for="lastname" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Nume</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('lastname', $medic['lastname'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Prenume</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('firstname', $medic['firstname'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">E-mail</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::email('email', $medic['email'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="practice" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Cabinet</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('practice', $medic['practice'], ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="doc_code" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Cod medic</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::text('doc_code', $medic['doc_code'], ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-lg-2 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">Adresa</label>

                <div class="col-lg-5 col-xs-10 col-xs-offset-1 col-md-offset-1 col-lg-offset-0 control-label">
                    {!! Form::textarea('address', $medic['address'], ['class' => 'form-control', 'rows' => '3'])!!}
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-5 col-xs-9 col-xs-offset-1 col-md-offset-1 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
                    <a href="{{ url('admin/remove_medic').'/'.$medic['id'] }}" class="btn btn-primary pull-right">Ștergere</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop