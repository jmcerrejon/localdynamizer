@extends('admin.layouts.app')

@section('title', 'Inicio')

@section('content')
      <div class="card md:mt-2">

        <!-- header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Inicio</h1>
        </div>
        <!-- end header -->

        <!-- body -->
        <div class="card-body grid grid-cols-2 gap-6 lg:grid-cols-1">

            <div class="p-2">
                <p class="text-black font-medium">Bienvenido</p>

                <div class="mt-20 mb-2 flex items-center">
                    <div class="py-1 px-3 rounded bg-green-200 text-green-900 mr-3">
                        <i class="fa fa-caret-up"></i>
                    </div>
                    <p class="text-black"><span class="num-2 text-green-400"></span><span
                            class="text-green-400">% more sales</span> in comparison to last month.</p>
                </div>

                <div class="flex items-center">
                    <div class="py-1 px-3 rounded bg-red-200 text-red-900 mr-3">
                        <i class="fa fa-caret-down"></i>
                    </div>
                    <p class="text-black"><span class="num-2 text-red-400"></span><span class="text-red-400">%
                            revenue per sale</span> in comparison to last month.</p>
                </div>

                <a href="#" class="btn-shadow mt-6">view details</a>

            </div>

            <div class="">
                <div id="sealsOverview"></div>
            </div>

        </div>
        <!-- end body -->

    </div>
@endsection