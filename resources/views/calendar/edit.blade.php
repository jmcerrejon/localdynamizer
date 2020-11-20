@extends('adminlte::page')

@section('title', 'Gestionar citas')

@section('content_header')
<h1 class="m-0 text-dark">Editar cita</h1>
@stop

@section('content')
@include('layouts.messages')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Eliminar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel"></h2>
            </div>
            <div class="modal-body">
                ¿Desea eliminar esta cita?
            </div>
            <div class="modal-footer">
                <form id="delete" action="{{ route('appointment.destroy', 1) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Si</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="box box-info">
    <form id="form_edit" role="form" enctype="multipart/form-data" class="form-horizontal" action="{{ route('appointment.update', $appointment->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-6 card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Título</label>
                            <input type="text" class="form-control" name="title" title="Título" placeholder="Título" value="{{ $appointment->title ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="start_time" class="control-label">Empieza</label>
                            <input type="datetime-local" class="form-control" name="start_time" title="Empieza" placeholder="Empieza" value="{{ \Carbon\carbon::parse($appointment->start_time)->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="form-group">
                            <label for="finish_time" class="control-label">Termina</label>
                            <input type="datetime-local" class="form-control" name="finish_time" title="Termina" placeholder="Termina" value="{{ \Carbon\carbon::parse($appointment->finish_time)->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="form-group">
                            <label for="comments" class="control-label">Comentarios</label>
                                <textarea rows="2" cols="50" type="text" class="form-control" name="comments" id="comments">{{ $appointment->comments ?? '' }}</textarea>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" onclick="window.location.href='{{ route('appointment.index') }}'">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction({{ $appointment->id }});" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="submit" class="btn btn-info pull-right" id="submit">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </form>
    <br>
    <br>
</div>
@stop

@section('js')
    <script>
        function modifyDeleteAction(item) {
            $('#id').val(item);
            $('#delete').attr('action', '{{ url('appointment') }}/'+item);
        }
    </script>
@stop