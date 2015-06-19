@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')
    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <legend><h3>Vizualizare pacient</h3></legend>
        <div class="row">
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">CNP</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['cnp'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['lastname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prenume</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['firstname'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
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
            <div class="col-lg-2 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vârsta</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['age'] }}</p></div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sex</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['sex'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">E-mail</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xs-offset-1 col-lg-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Adresa</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $patient['address'] }}</p></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-8 col-xs-offset-1">
                <div class="btn-group" role="group" style="margin:auto">
                    <a href="{{ url('medic/edit_patient').'/'.$patient['id'] }}"
                       class="btn btn-warning">Editare</a>
                    <a href="{{ url('medic/add_consult').'/'.$patient['id'] }}"
                       class="btn btn-success">Adăugare
                        consultație</a>
                </div>

                <div class="btn-group" role="group" style="margin:auto">
                    <a href="{{ url('medic/view_patientconsults').'/'.$patient['id'] }}"
                       class="btn btn-default">Consultaţii</a>
                    <a href="{{ url('medic/view_patientlabs').'/'.$patient['id'] }}"
                       class="btn btn-default">Analize</a>
                    <a href="{{ url('medic/view_patientvaccines').'/'.$patient['id'] }}"
                       class="btn btn-default">Vaccinări</a>
                    <a href="{{ url('medic/view_patienttreatments').'/'.$patient['id'] }}"
                       class="btn btn-default">Recomandări</a>
                    <a href="{{ url('medic/view_answers').'/'.$patient['id'] }}"
                       class="btn btn-default">Răspunsuri</a><br/>
                </div>
            </div>
        </div>
    </div>

@stop
