@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        <legend><h3>Vizualizare pacient</h3></legend>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">CNP</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['cnp'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['lastname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prenume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['firstname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data naşterii</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['birthDate'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vârsta</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['age'] }}</p></div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sex</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['sex'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adresa</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['address'] }}</p></div>
                </div>
            </div>
        </div>
        <div class="form-group patients-button-bar">
            <div class="btn-group btn-group-justified">
                <a href="{{url ('medic/edit_patient'.'/'.$patient['id'])}}"
                   class="btn btn-warning">Editare</a>
                <a href="{{url ('medic/edit_patient') }}"
                   class="btn btn-default">Istoric</a>
                <a href="{{url ('medic/add_consult'.'/'.$patient['id'])}}"
                   class="btn btn-primary">Adăugare consultaţie</a></div>
        </div>
    </div>

@stop
