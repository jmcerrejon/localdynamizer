@extends('adminlte::page')

@section('title', 'Gestionar citas')

@section('content_header')
<h1 class="m-0 text-dark">Crear cita</h1>

<p class="mb-0">Crea una cita para recordar eventos importantes, como visitas a clientes y/o establecimientos, subir contenido...</p>
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
                <form id="delete" action="{{ route('recursos.destroy', 1) }}" method="post">
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
    <!-- /.box-header -->
    <!-- form start -->
    <form id="form_edit" role="form" enctype="multipart/form-data" class="form-horizontal" action="{{ route('calendario.store') }}" method="post">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{ $appointment->id ?? '' }}">
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-6 card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="control-label">Título</label>
                            <input type="text" class="form-control" name="title" title="Título" placeholder="Título" value="">
                        </div>
                        <div class="form-group">
                            <label for="start_time" class="control-label">Empieza</label>
                            <input type="datetime-local" class="form-control" name="start_time" title="Empieza" placeholder="Empieza" value="{{ \Carbon\carbon::now()->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="form-group">
                            <label for="finish_time" class="control-label">Termina</label>
                            <input type="datetime-local" class="form-control" name="finish_time" title="Termina" placeholder="Termina" value="{{ \Carbon\carbon::now()->addHours(1)->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="form-group">
                            <label for="comments" class="control-label">Comentarios</label>
                                <textarea rows="2" cols="50" type="text" class="form-control" name="comments" id="comments">{{ old('body') ?? '' }}</textarea>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" onclick="window.location.href='{{ route('calendario.index') }}'">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
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
</div> <!-- /.box-footer -->
@stop

@section('js')
    <script>
        function modifyDeleteAction(item) {
            $('#id').val(item);
            $('#delete').attr('action', '{{ url('calendario') }}/'+item);
        }
    </script>
@stop