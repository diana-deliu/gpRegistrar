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
                    <input type="text" id="filter_title" class="form-control input-sm" placeholder="Titlu">
                </th>
                <th>
                    <input type="text" id="filter_start_date" class="form-control input-sm" placeholder="Dată de început">
                </th>
                <th>
                    <input type="text" id="filter_endate" class="form-control input-sm" placeholder="Dată de sfârșit">
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($surveys as $survey)

                <tr>

                    <td><a href="{{url('patient/survey_details').'/'.$survey['id']}}">{{ $survey['id'] }}</a></td>
                    <td>{{ $survey['title'] }}</td>
                    <td>{{ $survey['start_date'] }}</td>
                    <td>{{ $survey['end_date'] }}</td>
                </tr>
                </a>
            @endforeach
            </tbody>
        </table>
        @if(!count($surveys))
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