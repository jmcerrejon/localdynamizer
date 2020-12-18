@extends('admin.layouts.app')

@section('title', 'Gestor de Ficheros')


@section('content')
    <div class="card md:mt-2">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Gestor de Ficheros</h1>
        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid gap-6 grid-cols-1">
            <iframe src="{{ route('unisharp.lfm.show') }}"
                style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
        </div>
        <!-- end body -->

    </div>
@endsection
