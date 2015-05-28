@extends('layouts.master') @section('content')
    <div class="main_container">
        <div class="container">
            @include('partials.errors')
            <div class="col-lg-6 col-lg-offset-3 centered">
                {!! Form::open(['class' => 'form-horizontal form-medimpuls']) !!}
                <h3>Resetare parolă</h3>
                <fieldset>
                    {!! Form::hidden('token', $token, []) !!}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::email('email', old('email'), ['placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::password('password', ['placeholder' => 'Parola nouă', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::password('password_confirmation', ['placeholder' => 'Confirmaţi parola', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button type="submit" class="btn git btn-primary col-lg-4">Resetează-mi parola</button>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop
