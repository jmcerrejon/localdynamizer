@extends('adminlte::page')

@section('title', 'Recurso Video')

@section('content_header')
<h1 class="m-0 text-dark">Nuevo/Editar recurso</h1>

<p class="mb-0">Crea o edita nuevos recursos para ser usado por todos los dinamizadores. Echa a volar tu
    imaginación creando contenido para redes sociales.</p>
@stop

@section('content')
@include('layouts.messages')
<div class="box box-info">
    <!-- /.box-header -->
    <!-- form start -->
    <form id="form_edit" role="form" enctype="multipart/form-data" class="form-horizontal"
        action="{{ (isset($resource)) ? route('recursos.update', $resource->id) : route('recursos.store') }}"
        method="post">
        @csrf
        @if (isset($resource)) @method('PUT') @endif
        <input type="hidden" name="id" value="{{ $resource->id ?? '' }}">
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
                    name="body">{{ $resource->body ?? old('body') }}</textarea>
                <p class="help-block">Texto a desarrollar para ser usado en redes sociales. Lo mejor es que sea escueto
                    y no supere los 150 caracteres. Ayuda (inglés): <a target="_blank"
                        href="https://sproutsocial.com/insights/social-media-character-counter/">sproutsocial.com</a>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="resource_file" class="col-sm-2 control-label">Recurso multimedia</label>
            <div class="col-sm-10">
                @if (isset($resource) && ($resource->path))
                <div class="input-group">
                    <img width="352" height="288" src="{{ $resource->path ?? old('path') }}">
                </div>
                <br>
                @endif
                <div class="input-group">
                    <input type="file" class="form-control pull-right" title="Dirección del logo" name="resource_file" value="">
                </div>
                <p class="help-block">Resolución aconsejada máxima para imágenes: 2048x1024 | Máximo 5 Mb. Soportados:
                    jpg, png.
                    <br>Resolución aconsejada máxima para videos: 720p | Máximo 20 Mb. Soportados: .mp4.
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="hashtags" class="col-sm-2 control-label">Hashtags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="hashtags" title="Escribe los hashtags separados por coma"
                    placeholder="Escribe los hashtags separados por coma"
                    value="{{ $resource->hashtags ?? old('hashtags') }}">
                <p class="help-block">Pon tantos como puedas. Servirán sobretodo para etiquetar y organizar las búsquedas.</p>
            </div>
        </div>
        <div class="box-footer">
            @if (isset($resource))
            <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('recursos.index') }}'">Volver</button>
            @endif
            <button type="submit" class="btn btn-info pull-right" id="submit">Guardar</button>
        </div>
    </form>
    <br>
    <br>
</div> <!-- /.box-footer -->
@stop