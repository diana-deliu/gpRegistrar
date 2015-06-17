@extends('layouts.master') @section('content')
    <div class="main_container">
        <div class="container">
            @include('partials.errors')
            <div class="col-lg-6 col-lg-offset-3 centered">
                {!! Form::open(['class' => 'form-horizontal form-medimpuls']) !!}
                <h3>Recuperare parolă</h3>
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::email('email', old('email'), ['placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary col-lg-4">Trimite-mi parola</button>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop
