@extends('admin.layouts.app')

@section('title', 'Dinamizadores')

@section('content')
      <div class="card md:mt-2">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Dinamizadores</h1>
        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid grid-cols-2 gap-6 lg:grid-cols-1">
            <pre>
                @json($users->get())
            </pre>
        </div>
        <!-- end body -->

    </div>
@endsection