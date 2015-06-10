@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/import_patient', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Export Excel</h3></legend>
            <div class="row">
                <div class="panel panel-default col-xs-4 col-xs-offset-1">
                    <div class="panel-body">
                        <p>Se exportă numai fişiere în format <strong>Excel</strong>.</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-1">
                    <button type="submit" class="btn btn-success">Export</button>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}

    </div>
    </div>
@stop