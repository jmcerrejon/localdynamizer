@extends('adminlte::page')

@section('title', 'Home | Búsquedas')

@section('content_header')
<h1 class="m-0 text-dark">Búsquedas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><b>{{ $results->count() }} resultados encontrados para: "{{ request('q') }}"</b></div>
                <div class="card-body">
                    @foreach($results->groupByType() as $type => $modelresults)
                    <h2>{{ ucfirst($type) }}</h2>
                    @foreach($modelresults as $searchResult)
                    <ul>
                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
                    </ul>
                    {{-- @if ($type === 'hashtags') @break @endif --}}
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
