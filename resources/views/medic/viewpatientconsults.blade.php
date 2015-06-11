@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>
                    <div class="col-lg-4">
                        <input type="text" id="filter-date" class="form-control input-sm" placeholder="Dată">
                    </div>
                </th>
                <th>
                    Nume
                </th>
                <th>
                    Prenume
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($consults as $consult)
                <tr>
                    <td><a href="{{url('medic/consult_details').'/'.$consult['id']}}">{{ $consult['id'] }}</a></td>
                    <td>{{ $consult['date'] }}</td>
                    <td>{{ $consult['lastname'] }}</td>
                    <td>{{ $consult['firstname'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(!count($consults))
            <tr>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-danger" style="text-align:center;"><strong>Nu s-a găsit nicio întregistrare pentru acest pacient!</strong></p>
                    </div>
                </div>
            </tr>
        @endif
    </div>
@stop
@section('footer_scripts')
    @include('partials.table_row_link')
@stop