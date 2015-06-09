@extends('layouts.master')

@section('content')

    @include('partials.medic_left_sidebar')

    <div class="main_container">
        @include('partials.errors')
        @include('partials.error')
        {!! Form::open(['url' => 'medic/create_survey', 'class' => 'form-horizontal']) !!}
        <fieldset>
            <div class="inputs">
                <legend><h3>Adăugare chestionar</h3></legend>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Titlu chestionar</label>
                    <div class="col-lg-2">
                        {!! Form::text('title', old('title'), ['class' => 'form-control'])!!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date" class="col-lg-2 control-label">Dată de început</label>

                    <div class="col-lg-2">
                        <div class="container">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="input-group date datetimepicker">
                                        {!! Form::text('start_date', old('start_date'), ['class' => 'form-control'])!!}
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
                    <label for="end_date" class="col-lg-2 control-label">Dată de sfârşit</label>

                    <div class="col-lg-2">
                        <div class="container">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <div class="input-group date datetimepicker">
                                        {!! Form::text('end_date', old('end_date'), ['class' => 'form-control'])!!}
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
                <?php
                    $max = 3;
                    $touched = false;
                    foreach(old() as $key => $old) {
                        if (starts_with($key, "question")) {
                            if(!$touched) {
                                $max = 1;
                                $touched = true;
                            }
                            $index = intval(substr($key, 8, strlen($key)));
                            if($index > $max) {
                                $max = $index;
                            }
                        }
                    }
                ?>
                @for($i = 1; $i <= $max; $i++)
                    <div class="form-group">
                        <label for="question{{$i}}" class="col-lg-2 control-label">Întrebarea {{$i}}</label>

                        <div class="col-lg-3">
                            {!! Form::text('question'.$i, old('question'.$i), ['id' => 'question'.$i, 'class' => 'form-control question'])!!}
                            <span class="help-block"></span>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="form-group">
                <div class="col-lg-3 col-lg-offset-2">
                    <button type="submit" class="btn btn-default">Adăugare</button>
                    <a href="#" class="btn btn-success pull-right" title="Adăugare întrebare" id="btn-plus"><span
                                class="glyphicon glyphicon-plus"></span></a>
                    <a href="#" class="btn btn-primary pull-right" title="Eliminare întrebare" id="btn-minus"><span
                                class="glyphicon glyphicon-minus"></span></a>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
@stop
@section('footer_scripts')
    @include('partials.date_picker')
    @include('partials.patients_dropdown')
    @include('partials.popover')

    <script>
        function incrementQuestionChunk(chunk) {
            var chunk = chunk.replace(/question(\d+)/g, function (value) {
                var id = parseInt(value.match(/\d+$/)[0]);
                return "question" + (id + 1);
            });
            var chunk = chunk.replace(/Întrebarea (\d+)/g, function (value) {
                var id = parseInt(value.match(/\d+$/)[0]);
                return "Întrebarea " + (id + 1);
            });
            return chunk;
        }
        function appendToInputs(chunk) {
            chunk = "<div class=\"form-group\">" + chunk + "</div>";
            $(".inputs").append(chunk);
        }
        function removeLastQuestion() {
            var noQuestions = $(".question").size();
            if (noQuestions > 2) {
                $(".question:last").parent().parent().remove();
            }
        }
        $("#btn-plus").click(function () {
            var oldChunk = $(".question:last").parent().parent().html();
            appendToInputs(incrementQuestionChunk(oldChunk));
        });
        $("#btn-minus").click(function () {
            removeLastQuestion();
        });
    </script>
@stop
