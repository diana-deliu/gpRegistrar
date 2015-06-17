@extends('layouts.master') @section('content')
    <div class="main_container">
        <div class="container">
            @include('partials.errors')
            @include('partials.error')
            <div class="col-lg-6 col-lg-offset-3 centered">
                {!! Form::open(['class' => 'form-horizontal form-medimpuls']) !!}
                <h3>Înregistrare</h3>
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::input('number', 'cnp', old('CNP'), ['placeholder' => 'CNP', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::email('email', old('email'), ['placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::password('password', ['placeholder' => 'Parola dorită', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::password('password_confirmation', ['placeholder' => 'Confirmare parolă', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary col-lg-4">Înregistrare</button>
                            <div class="pull-right">
                                <a href="{{ url('/auth/login') }}">Aveti deja cont?</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop
