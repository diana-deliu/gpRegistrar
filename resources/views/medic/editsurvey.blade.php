@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::model($survey, ['url' => 'medic/update_survey/'.$survey['id'], 'class' => 'form-horizontal']) !!}
        <fieldset>
            <legend><h3>Editare chestionar</h3></legend>
            <div class="form-group">
                <label for="title" class="col-lg-2 control-label">Titlu</label>

                <div class="col-lg-6">
                    {!! Form::text('title', $survey['title'], ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="form-group">
                <label for="start_date" class="col-lg-2 control-label">Dată de început</label>

                <div class="col-lg-2">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class='input-group date' class="datetimepicker">
                                    {!! Form::text('start_date', $survey['start_date'], ['class' => 'form-control'])!!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="end_date" class="col-lg-2 control-label">Dată de sfârșit</label>

                <div class="col-lg-2">
                    <div class="container">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <div class='input-group date' class="datetimepicker">
                                    {!! Form::text('end_date', $survey['end_date'], ['class' => 'form-control'])!!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @for($i = 1; $i <= 3; $i++)
                <div class="form-group">
                    <label for="question{{$i}}" class="col-lg-2 control-label">Întrebarea {{$i}}</label>

                    <div class="col-lg-3">
                        {!! Form::text('question'.$i, old('question'.$i), ['id' => 'question'.$i, 'class' => 'form-control question'])!!}
                        <span class="help-block"></span>
                    </div>
                </div>
            @endfor
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-2">
                    <button type="submit" class="btn btn-warning">Editare</button>
                    <a href="{{ url('medic/remove_patient').'/'.$patient['id'] }}"
                       class="btn btn-primary pull-right">Ștergere</a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop