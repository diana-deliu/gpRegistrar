@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        <table class="table table-striped table-hover ">
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
                    <td>{{ $patient['id'] }}</td>
                    <td>{{ $patient['cnp'] }}</td>
                    <td>{{ $patient['lastname'] }}</td>
                    <td>{{ $patient['firstname'] }}</td>
                    <td>{{ $patient['email'] }}</td>
                    <td><a href="{{url ('medic/edit_patient').'/'.$patient['id']}}"
                           class="btn btn-warning btn-xs">Editare</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop