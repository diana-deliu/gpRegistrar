@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <table class="table table-striped table-hover patients">
            <thead>
            <tr>
                <th>Id</th>
                <th>
                    <input type="number" id="filter_cnp" class="form-control input-sm" placeholder="CNP">
                </th>
                <th>
                    <input type="text" id="filter_lastname" class="form-control input-sm" placeholder="Nume">
                </th>
                <th>
                    <input type="text" id="filter_firstname" class="form-control input-sm" placeholder="Prenume">
                </th>
                <th>
                    <input type="text" id="filter_email" class="form-control input-sm" placeholder="Email">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $patient)

                <tr>
                    <td><a href="{{url('medic/patient_details').'/'.$patient['id']}}">{{ $patient['id'] }}</a></td>
                    <td>{{ $patient['cnp'] }}</td>
                    <td>{{ $patient['lastname'] }}</td>
                    <td>{{ $patient['firstname'] }}</td>
                    <td>{{ $patient['email'] }}</td>
                </tr>
                </a>
            @endforeach
            </tbody>
            @if(!count($patients))
                <tr>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="text-danger" style="text-align:center;"><strong>Nu s-a găsit nicio întregistrare!</strong></p>
                        </div>
                    </div>
                </tr>
            @endif
        </table>
        <a href="{{ url ('medic/import_patient') }}" class="btn btn-success"> Import</a>
        <a href="{{ url ('medic/export_patient') }}" class="btn btn-primary pull-right" target="_blank"> Export</a>
    </div>
@stop
@section('footer_scripts')
    @include('partials.table_row_link')
@stop