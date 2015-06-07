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
            </tr>
            </thead>
            <tbody>
            @foreach($consults as $consult)
                <tr>
                    <td><a href="{{url('medic/consults_details').'/'.$consult['id']}}">{{ $consult['id'] }}</a></td>
                    <td>{{ $consult['date'] }}</td>
                    <td>{{ $consult['lastname'] }}</td>
                    <td>{{ $consult['firstname'] }}</td>
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