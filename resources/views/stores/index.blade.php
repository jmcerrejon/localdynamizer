@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">Establecimientos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Aquí se muestra un listado de todos los establecimientos que has conseguido.</p>
                    <br>
                    En la base de datos por ahora tenemos datos de mentira (fake), he aquí los {{ count($totalStores) }} primeros:
                    <ul>
                        @foreach($totalStores as $store)
                            <li>{{ $store->comercial_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
