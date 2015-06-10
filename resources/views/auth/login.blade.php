@extends('layouts.master') @section('content')
    <div class="main_container">
        <div class="container">
            @include('partials.errors')
            <div class="col-lg-6 col-lg-offset-3">
                {!! Form::open(['class' => 'form-horizontal form-medimpuls']) !!}
                <h3>Autentificare</h3>
                <fieldset>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::email('email', old('email'), ['placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::password('password', ['placeholder' => 'Parola', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <span>
                                {!! Form::checkbox('remember', null, null, []) !!}
                                {!! Form::label('remember', 'Ţine-mă minte') !!}
                                <span class="help-block"></span>
                            </span>
                            <button type="submit" class="btn btn-primary col-lg-4">Autentificare</button>

                            <div class="pull-right">
                                <a href="{{ url('/auth/register') }}">Nu aveţi cont activ?</a><br/>
                                <a href="{{ url('/password/email') }}">Aţi uitat parola?</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop
