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
                    <input type="text" id="filter_date" class="form-control input-sm" placeholder="Dată">
                </th>
                <th>
                    <input type="text" id="filter_lastname" class="form-control input-sm" placeholder="Nume">
                </th>
                <th>
                    <input type="text" id="filter_firstname" class="form-control input-sm" placeholder="Prenume">
                </th>
                <th>
                    <input type="text" id="filter_category" class="form-control input-sm" placeholder="Categorie">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($vaccines as $vaccine)
                <tr>
                    <td><a href="{{url('medic/vaccine_details').'/'.$vaccine['id']}}">{{ $vaccine['id'] }}</a></td>
                    <td>{{ $vaccine['date'] }}</td>
                    <td>{{ $vaccine['lastname'] }}</td>
                    <td>{{ $vaccine['firstname'] }}</td>
                    <td>{{ $vaccine['category'] }}</td>
                </tr>
                </a>
            @endforeach
            </tbody>
        </table>
        @if(!count($vaccines))
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