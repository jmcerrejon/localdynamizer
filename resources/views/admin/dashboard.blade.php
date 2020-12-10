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
                <section
    class="box-border block leading-5 mx-auto p-4 text-gray-800"
    style="min-height: 250px; quotes: auto"
>
    <!-- Small boxes (Stat box) -->
    <div class="table clear-both -mx-4" style="content: ' '; quotes: auto">
        <div
            class="xl:float-left xl:w-1/4 box-border float-left leading-5 px-4 relative text-gray-800 w-1/2"
            style="min-height: 1px; quotes: auto"
        >
            <!-- small box -->
            <div
                class="bg-blue-500 rounded-sm block mb-5 shadow-xs text-white hover:text-gray-100 hover:no-underline"
                style="quotes: auto"
            >
                <div class="box-border leading-5 p-2" style="quotes: auto">
                    <h3
                        class="font-sans text-4xl mx-0 mt-0 mb-2 p-0 whitespace-no-wrap"
                        style="
                            font-weight: bold;
                            line-height: 1.1;
                            z-index: 5;
                            quotes: auto;
                        "
                    >
                        {{ $statistics['total_users'] }}
                    </h3>

                    <p
                        class="text-sm mx-0 mt-0 mb-2 text-white"
                        style="z-index: 5; line-height: 1.42857; quotes: auto"
                    >
                        Total dinamizadores
                    </p>
                </div>
                <div
                    class="box-border absolute text-gray-400 z-0"
                    style="
                        transition: all 0.3s linear 0s;
                        top: -10px;
                        right: 10px;
                        font-size: 90px;
                        line-height: 1.42857;
                        quotes: auto;
                    "
                >
                    <i
                        class="inline-block leading-none not-italic normal-case"
                        style="
                            font-family: Ionicons;
                            speak: none;
                            font-weight: normal;
                            font-variant: normal;
                            text-rendering: auto;
                            font-size: 90px;
                            quotes: auto;
                        "
                    ></i>
                </div>
                <a
                    href="#"
                    class="bg-gray-300 box-border cursor-pointer leading-5 px-0 py-1 relative text-center no-underline z-10 hover:bg-gray-400 hover:text-white focus:text-blue-400 focus:no-underline"
                    style="quotes: auto"
                    >Mas info
                    <i
                        class="cursor-pointer inline-block leading-none text-white not-italic"
                        style="
                            font-variant: normal;
                            font-weight: normal;
                            font-stretch: normal;
                            font-family: FontAwesome;
                            text-rendering: auto;
                            quotes: auto;
                        "
                    ></i
                ></a>
            </div>
        </div>
        <!-- ./col -->
        <div
            class="xl:float-left xl:w-1/4 box-border float-left leading-5 px-4 relative text-gray-800 w-1/2"
            style="min-height: 1px; quotes: auto"
        >
            <!-- small box -->
            <div
                class="bg-green-700 rounded-sm block mb-5 shadow-xs text-white hover:text-gray-100 hover:no-underline"
                style="quotes: auto"
            >
                <div class="box-border leading-5 p-2" style="quotes: auto">
                    <h3
                        class="font-sans text-4xl mx-0 mt-0 mb-2 p-0 whitespace-no-wrap"
                        style="
                            font-weight: bold;
                            line-height: 1.1;
                            z-index: 5;
                            quotes: auto;
                        "
                    >
                        {{ $statistics['total_sum_invoices'] }}
                        <sup
                            style="
                                font-size: 20px;
                                line-height: 0;
                                top: -0.5em;
                                quotes: auto;
                            "
                            class="box-border font-bold text-xl relative text-white align-baseline"
                            >€</sup
                        >
                    </h3>

                    <p
                        class="text-sm mx-0 mt-0 mb-2 text-white"
                        style="z-index: 5; line-height: 1.42857; quotes: auto"
                    >
                        Total facturas
                    </p>
                </div>
                <div
                    class="box-border absolute text-gray-400 z-0"
                    style="
                        transition: all 0.3s linear 0s;
                        top: -10px;
                        right: 10px;
                        font-size: 90px;
                        line-height: 1.42857;
                        quotes: auto;
                    "
                >
                    <i
                        class="inline-block leading-none not-italic normal-case"
                        style="
                            font-family: Ionicons;
                            speak: none;
                            font-weight: normal;
                            font-variant: normal;
                            text-rendering: auto;
                            font-size: 90px;
                            quotes: auto;
                        "
                    ></i>
                </div>
                <a
                    href="#"
                    class="bg-gray-300 box-border cursor-pointer leading-5 px-0 py-1 relative text-center no-underline z-10 hover:bg-gray-400 hover:text-white focus:text-blue-400 focus:no-underline"
                    style="quotes: auto"
                    >Mas info
                    <i
                        class="cursor-pointer inline-block leading-none text-white not-italic"
                        style="
                            font-variant: normal;
                            font-weight: normal;
                            font-stretch: normal;
                            font-family: FontAwesome;
                            text-rendering: auto;
                            quotes: auto;
                        "
                    ></i
                ></a>
            </div>
        </div>
        <!-- ./col -->
        <div
            class="xl:float-left xl:w-1/4 box-border float-left leading-5 px-4 relative text-gray-800 w-1/2"
            style="min-height: 1px; quotes: auto"
        >
            <!-- small box -->
            <div
                class="bg-yellow-600 rounded-sm block mb-5 shadow-xs text-white hover:text-gray-100 hover:no-underline"
                style="quotes: auto"
            >
                <div class="box-border leading-5 p-2" style="quotes: auto">
                    <h3
                        class="font-sans text-4xl mx-0 mt-0 mb-2 p-0 whitespace-no-wrap"
                        style="
                            font-weight: bold;
                            line-height: 1.1;
                            z-index: 5;
                            quotes: auto;
                        "
                    >
                        {{ $statistics['total_resources'] }}
                    </h3>

                    <p
                        class="text-sm mx-0 mt-0 mb-2 text-white"
                        style="z-index: 5; line-height: 1.42857; quotes: auto"
                    >
                        Total recursos
                    </p>
                </div>
                <div
                    class="box-border absolute text-gray-400 z-0"
                    style="
                        transition: all 0.3s linear 0s;
                        top: -10px;
                        right: 10px;
                        font-size: 90px;
                        line-height: 1.42857;
                        quotes: auto;
                    "
                >
                    <i
                        class="inline-block leading-none not-italic normal-case"
                        style="
                            font-family: Ionicons;
                            speak: none;
                            font-weight: normal;
                            font-variant: normal;
                            text-rendering: auto;
                            font-size: 90px;
                            quotes: auto;
                        "
                    ></i>
                </div>
                <a
                    href="#"
                    class="bg-gray-300 box-border cursor-pointer leading-5 px-0 py-1 relative text-center no-underline z-10 hover:bg-gray-400 hover:text-white focus:text-blue-400 focus:no-underline"
                    style="quotes: auto"
                    >Mas info
                    <i
                        class="cursor-pointer inline-block leading-none text-white not-italic"
                        style="
                            font-variant: normal;
                            font-weight: normal;
                            font-stretch: normal;
                            font-family: FontAwesome;
                            text-rendering: auto;
                            quotes: auto;
                        "
                    ></i
                ></a>
            </div>
        </div>
        <!-- ./col -->
        <div
            class="xl:float-left xl:w-1/4 box-border float-left leading-5 px-4 relative text-gray-800 w-1/2"
            style="min-height: 1px; quotes: auto"
        >
            <!-- small box -->
            <div
                class="bg-red-600 rounded-sm block mb-5 shadow-xs text-white hover:text-gray-100 hover:no-underline"
                style="quotes: auto"
            >
                <div class="box-border leading-5 p-2" style="quotes: auto">
                    <h3
                        class="font-sans text-4xl mx-0 mt-0 mb-2 p-0 whitespace-no-wrap"
                        style="
                            font-weight: bold;
                            line-height: 1.1;
                            z-index: 5;
                            quotes: auto;
                        "
                    >
                        {{ $statistics['total_stores'] }}
                    </h3>

                    <p
                        class="text-sm mx-0 mt-0 mb-2 text-white"
                        style="z-index: 5; line-height: 1.42857; quotes: auto"
                    >
                        Total establecimientos
                    </p>
                </div>
                <div
                    class="box-border absolute text-gray-400 z-0"
                    style="
                        transition: all 0.3s linear 0s;
                        top: -10px;
                        right: 10px;
                        font-size: 90px;
                        line-height: 1.42857;
                        quotes: auto;
                    "
                >
                    <i
                        class="inline-block leading-none not-italic normal-case"
                        style="
                            font-family: Ionicons;
                            speak: none;
                            font-weight: normal;
                            font-variant: normal;
                            text-rendering: auto;
                            font-size: 90px;
                            quotes: auto;
                        "
                    ></i>
                </div>
                <a
                    href="#"
                    class="bg-gray-300 box-border cursor-pointer leading-5 px-0 py-1 relative text-center no-underline z-10 hover:bg-gray-400 hover:text-white focus:text-blue-400 focus:no-underline"
                    style="quotes: auto"
                    >Mas info
                    <i
                        class="cursor-pointer inline-block leading-none text-white not-italic"
                        style="
                            font-variant: normal;
                            font-weight: normal;
                            font-stretch: normal;
                            font-family: FontAwesome;
                            text-rendering: auto;
                            quotes: auto;
                        "
                    ></i
                ></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->
</section>


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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="/admin/js/scripts.js"></script>
@endsection