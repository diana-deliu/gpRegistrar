@extends('layouts.master')

@section('content')

    @include('partials.admin_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Id</th>
                <th>
                    <input type="text" id="filter_doc_code" class="form-control input-sm" placeholder="Cod medic">
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
                <th>
                    <input type="text" id="filter_practice" class="form-control input-sm" placeholder="Cabinet">
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($medics as $medic)

                <tr>
                    <td><a href="{{url('admin/edit_medic'). '/'. $medic['id']}}">{{ $medic['id'] }}</a></td>
                    <td>{{ $medic['doc_code'] }}</td>
                    <td>{{ $medic['lastname'] }}</td>
                    <td>{{ $medic['firstname'] }}</td>
                    <td>{{ $medic['email'] }}</td>
                    <td>{{ $medic['practice'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop