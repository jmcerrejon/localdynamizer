@extends('adminlte::page')

@section('title', 'Establecimientos > Editar horarios')

@section('css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/taggle.css') }}">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Editar horarios</h1>
@stop

@section('content')
    @include('layouts.messages')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Horarios de apertura y cierre para <i>{{ $store->business_name }}</i>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form_edit" role="form" class="form-horizontal" action="{{ route('establecimientos.save-opening', $store->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $store->id}}">

                    <div class="form-group">
                        <label for="interval" class="col-sm-2 control-label">Editar horarios</label>

                        <div class="col-sm-10">
                            <p>
                                <b>Lunes, </b>
                                <input type="text" name="day_range[0][1]" value="{{ $opening_hours['monday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                 - <input type="text" name="day_range[0][2]" value="{{ $opening_hours['monday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                 | <input type="text" name="day_range[0][3]" value="{{ $opening_hours['monday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                 - <input type="text" name="day_range[0][4]" value="{{ $opening_hours['monday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Martes, </b>
                                <input type="text" name="day_range[1][1]" value="{{ $opening_hours['tuesday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[1][2]" value="{{ $opening_hours['tuesday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[1][3]" value="{{ $opening_hours['tuesday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[1][4]" value="{{ $opening_hours['tuesday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Miércoles, </b>
                                <input type="text" name="day_range[2][1]" value="{{ $opening_hours['wednesday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[2][2]" value="{{ $opening_hours['wednesday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[2][3]" value="{{ $opening_hours['wednesday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[2][4]" value="{{ $opening_hours['wednesday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Jueves, </b>
                                <input type="text" name="day_range[3][1]" value="{{ $opening_hours['thursday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[3][2]" value="{{ $opening_hours['thursday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[3][3]" value="{{ $opening_hours['thursday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[3][4]" value="{{ $opening_hours['thursday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Viernes, </b>
                                <input type="text" name="day_range[4][1]" value="{{ $opening_hours['friday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[4][2]" value="{{ $opening_hours['friday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[4][3]" value="{{ $opening_hours['friday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[4][4]" value="{{ $opening_hours['friday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Sábado, </b>
                                <input type="text" name="day_range[5][1]" value="{{ $opening_hours['saturday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[5][2]" value="{{ $opening_hours['saturday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[5][3]" value="{{ $opening_hours['saturday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[5][4]" value="{{ $opening_hours['saturday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                            <p>
                                <b>Domingo, </b>
                                <input type="text" name="day_range[6][1]" value="{{ $opening_hours['sunday'][0][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[6][2]" value="{{ $opening_hours['sunday'][0][1] ?? '' }}" maxlength="5" size="5"></input>
                                | <input type="text" name="day_range[6][3]" value="{{ $opening_hours['sunday'][1][0] ?? '' }}" maxlength="5" size="5"></input>
                                - <input type="text" name="day_range[6][4]" value="{{ $opening_hours['sunday'][1][1] ?? '' }}" maxlength="5" size="5"></input>
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exceptions" class="col-sm-4 control-label">
                            Excepciones <i title="Días que no se trabaja o con horarios especiales" class="icon fa fa-info-circle"></i> <small>Añade excepciones y pulsa TAB o ENTER</small>
                        </label>

                        <div class="col-sm-10">
                            <div id="exceptions" class="form-control"></div>
                        </div>
                    </div>
                    <small>Ejemplo excepciones: 31/12 | 06/06/2020 | 25/12,09:00-14:00 | 25/12/2021,09:00-14:00,17:00-21:00</small>
                    <br>
                    <br>

                    <div class="box-footer">
                        <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('establecimientos.show', $store->id) }}'">Volver</button>

                        <button type="submit" class="btn btn-info pull-right" id="submit">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="/js/taggle.min.js"></script>
<script>
    $(document).ready( function () {
        const arrCurrentExceptions = @json($exceptions);

        const activityTag = new Taggle('exceptions', {
            tags: arrCurrentExceptions,
            submitKeys: [9, 13],
            delimiter: [';'],
            duplicateTagClass: 'bounce'
        });
    });
</script>
@stop