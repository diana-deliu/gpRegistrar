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
                <th>
                    <input type="text" id="filter_interval" class="form-control input-sm" placeholder="Interval">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($vaccines as $vaccine)
                <tr>
                    <td><a href="{{url('medic/vaccine_details').'/'.$vaccine['id']}}">{{ $vaccine['id'] }}</a></td>
                    <td>{{ $vaccine['start_date'] }}</td>
                    <td>{{ $vaccine['lastname'] }}</td>
                    <td>{{ $vaccine['firstname'] }}</td>
                    <td>{{ $vaccine['category'] }}</td>
                    <td>{{ $vaccine['interval'] }}</td>
                </tr>
                </a>

            @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('footer_scripts')
    @include('partials.table_row_link')
@stop