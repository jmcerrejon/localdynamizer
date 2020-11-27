@extends('adminlte::page')

@section('title', 'Editar recurso')

@section('content_header')
<h1 class="m-0 text-dark">Editar recurso</h1>

<p class="mb-0">Edita recursos que ya hayas subido previamente. Echa a volar tu imaginación creando contenido para redes sociales.</p>
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
                ¿Desea eliminar este recurso?
            </div>
            <div class="modal-footer">
                <form id="delete" action="{{ route('recursos.destroy', 1) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="published" value="0">
                    <input type="hidden" id="id" name="id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Si</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="box box-info">
    <form id="form_edit" role="form" enctype="multipart/form-data" class="form-horizontal"
        action="{{ (isset($resource)) ? route('recursos.update', $resource->id) : route('recursos.store') }}"
        method="post">
        @csrf
        @if (isset($resource)) @method('PUT') @endif
        <input type="hidden" name="published" value="0">
        <input type="hidden" name="id" value="{{ $resource->id ?? '' }}">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Título *</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" title="Descripción de lo que representa el recurso"
                    placeholder="Descripción de lo que representa el recurso" value="{{ $resource->title ?? old('title') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="published" class="col-sm-2 control-label">¿Publicado?</label>

            <div class="col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="published" title="activado = se publica" @if ((isset($resource) && $resource->published) || old('published')) checked @endif>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="mime_id" class="col-sm-2 control-label">Tipo de recurso</label>
            <div class="col-sm-10">
                <select id="mime_id" name="mime_id" class="form-control">
                    @foreach($mimes as $mime)
                    <option value="{{ $mime->id }}" @if ((isset($resource)) && ($mime->id ===$resource->mime_id)) selected @endif>{{ $mime->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="body" class="col-sm-2 control-label">Mensaje/Descripción</label>

            <div class="col-sm-10">
                <textarea rows="2" cols="50" type="text" class="form-control"
                    name="body" id="body">{{ $resource->body ?? old('body') }}</textarea>
                <p class="help-block">Texto a desarrollar para ser usado en redes sociales. Lo mejor es que sea escueto
                    y no supere los 150 caracteres. Ayuda (inglés): <a target="_blank"
                        href="https://sproutsocial.com/insights/social-media-character-counter/">sproutsocial.com</a>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="resource_file" class="col-sm-2 control-label">Recurso multimedia</label>
            <div class="col-sm-10">
                <div class="input-group">
                    @if (isset($resource) && ($resource->path))
                        @switch($resource->mime_id)
                        @case(2)
                        @case(4)
                    <img width="352" height="288" src="{{ $resource->path ?? old('path') }}">
                        @break
                        @case(3)
                    <video controls width="528">
                        <source src="{{ $resource->path ?? old('path') }}" type="video/mp4">
                        Lo siento, tu navegador no soporta vídeos incrustados.
                    </video>
                        @break
                        @endswitch
                    @endif
                </div>
                @if (isset($resource) && auth()->user()->id === $resource->user_id)
                <br>
                <div class="input-group">
                    <input type="file" class="form-control pull-right" title="Dirección del logo" name="resource_file" value="">
                </div>
                <p class="help-block">Resolución aconsejada máxima para imágenes: 2048x1024 | Máximo 5 Mb. Soportados:
                    jpg, png.
                    <br>Resolución aconsejada máxima para videos: 720p | Máximo 20 Mb. Soportados: .mp4.
                </p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="hashtags" class="col-sm-2 control-label">Hashtags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="hashtags" title="Escribe los hashtags separados por coma"
                    placeholder="Escribe los hashtags separados por coma"
                    value="{{ addHashTag($resource->hashtags) ?? old('hashtags') }}">
                <p class="help-block">Pon tantos como puedas separados por coma. Servirán sobretodo para etiquetar y organizar las búsquedas.</p>
            </div>
        </div>
        <div class="box-footer">
            @if (isset($resource))
            <a class="btn btn-default" onclick="window.location.href='{{ route('recursos.index') }}'">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            @endif
            @if (isset($resource) && auth()->user()->id === $resource->user_id)
            <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#myModal" onclick="modifyDeleteAction({{ $resource->id }});" title="Eliminar">
                <i class="fas fa-trash"></i>
            </button>
            <button type="submit" class="btn btn-info pull-right" id="submit">
                <i class="fas fa-save"></i> Guardar
            </button>
            @endif
        </div>
    </form>
    <br>
    <br>
</div> <!-- /.box-footer -->
@stop

@section('js')
    <script src="/js/dcounts-js.min.js"></script>
    <script>
        const formElementsEnabled = @if (isset($resource) && auth()->user()->id === $resource->user_id) false @else true @endif;
        dCounts('body', 150, document.getElementById('body').value.length); // without #

        function modifyDeleteAction(item) {
            $('#id').val(item);
            $('#delete').attr('action', '{{ url('recursos') }}/'+item);
        }

        function toggleFormElements(bDisabled) { 
            var inputs = document.getElementsByTagName("input"); 
            for (var i = 0; i < inputs.length; i++) { 
                inputs[i].disabled = bDisabled;
            } 
            var selects = document.getElementsByTagName("select");
            for (var i = 0; i < selects.length; i++) {
                selects[i].disabled = bDisabled;
            }
            var textareas = document.getElementsByTagName("textarea"); 
            for (var i = 0; i < textareas.length; i++) { 
                textareas[i].disabled = bDisabled;
            }
            var buttons = document.getElementsByTagName("button");
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = bDisabled;
            }
        }

        toggleFormElements(formElementsEnabled);
    </script>
@stop