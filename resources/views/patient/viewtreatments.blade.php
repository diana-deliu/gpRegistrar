@extends('layouts.master')

@section('content')

    @include('partials.patient_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <table class="table table-striped table-hover patients">
            <thead>
            <tr>
                <th>Id</th>
                <th>
                    <input type="text" id="filter_date" class="form-control input-sm" placeholder="Dată">
                </th>
                <th>
                    <input type="text" id="filter_lastname" class="form-control input-sm" placeholder="Nume">
                </th>
                <th>
                    <input type="text" id="filter_firstname" class="form-control input-sm" placeholder="Prenume">
                </th>
                <th>
                    <input type="text" id="filter_diagnosis" class="form-control input-sm" placeholder="Diagnostic">
                </th>
                <th>
                    <input type="text" id="filter_treatment" class="form-control input-sm" placeholder="Tratament">
                </th>
                <th>
                    <input type="text" id="filter_extra" class="form-control input-sm" placeholder="Specificații">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($treatments as $treatment)
                <tr>
                    <td><a href="{{url('patient/treatment_details').'/'.$treatment['id']}}">{{ $treatment['id'] }}</a></td>
                    <td>{{ $treatment['date'] }}</td>
                    <td>{{ $treatment['lastname'] }}</td>
                    <td>{{ $treatment['firstname'] }}</td>
                    <td>{{ $treatment['diagnosis'] }}</td>
                    <td>{{ $treatment['treatment'] }}</td>
                    <td>{{ $treatment['extra'] }}</td>
                </tr>
                </a>
            @endforeach
            </tbody>
        </table>
        @if(!count($treatments))
            <tr>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-danger" style="text-align:center;"><strong>Nu s-a găsit nicio întregistrare!</strong></p>
                    </div>
                </div>
            </tr>
        @endif
    </div>
@stop
@section('footer_scripts')
    @include('partials.table_row_link')
@stop