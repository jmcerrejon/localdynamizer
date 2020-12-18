@extends('adminlte::page')

@section('title', 'Gestor de Ficheros')

@section('content_header')
    <h1 class="m-0 text-dark">Gestor de Ficheros</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <iframe src="{{ route('unisharp.lfm.show') }}"
                        style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
@stop
