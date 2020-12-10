<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Jose Manuel Cerrejon Gonzalez" />
    <link rel="apple-touch-icon" sizes="57x57" href="./favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="./favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/style.css">
    <title>@yield('title') - Panel Web</title>
</head>

<body class="bg-gray-100">

    <!-- start navbar -->
    <div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">

        <!-- logo -->
        <div class="flex-none w-56 flex flex-row items-center">
            <img src="/images/logos/logo_min.png" class="w-10 flex-none">
            <strong class="capitalize ml-1 flex-1">Panel Administrador</strong>

            <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
                <i class="fad fa-list-ul"></i>
            </button>
        </div>
        <!-- end logo -->

        <!-- navbar content toggle -->
        <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
            <i class="fad fa-chevron-double-down"></i>
        </button>
        <!-- end navbar content toggle -->

        <!-- search -->
        <div class="relative mx-6 sm:mx-0">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
            </span>

            <input class="form-input w-36 sm:w-64 border-2 rounded border-gray-200 pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="Buscar">
        </div>
        <!-- end search -->

        <!-- navbar content -->
        <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
            <!-- left -->
            <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200"></div>
            <!-- end left -->

            <!-- right -->
            <div class="flex flex-row-reverse items-center">

                <!-- user -->
                <div class="dropdown relative md:static">

                    <button class="menu-btn focus:outline-none focus:shadow-outline flex flex-wrap items-center">
                        <div class="ml-2 capitalize flex ">
                            <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ Auth::user()->name }}</h1>
                            <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
                        </div>
                    </button>

                    <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                    <div class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster">
                        <hr>

                        <!-- item -->
                        <form method="GET" action="{{ route('admin.logout') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out"
                            href="logout" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fad fa-user-times text-xs mr-1"></i>
                            Cerrar sesión
                        </a>
                        </form>
                        <!-- end item -->

                    </div>
                </div>
                <!-- end user -->

                <!-- notifcation -->
                <!-- end notifcation -->

                <!-- messages -->
                <!-- end messages -->


            </div>
            <!-- end right -->
        </div>
        <!-- end navbar content -->

    </div>
    <!-- end navbar -->

    <!-- strat wrapper -->
    <div class="h-screen flex flex-row flex-wrap">

        <!-- start sidebar -->
        <div id="sideBar" class="relative flex flex-col flex-wrap bg-gray-900 border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">

            <!-- sidebar content -->
            <div class="flex flex-col">

                <!-- sidebar toggle -->
                <div class="text-right hidden md:block mb-4">
                    <button id="sideBarHideBtn">
                        <i class="fad fa-times-circle"></i>
                    </button>
                </div>
                <!-- end sidebar toggle -->

                <!-- link -->
                <a href="{{ route('admin.home') }}" class="mb-3 capitalize font-medium text-lg hover:text-teal-600 transition ease-in-out duration-500 text-gray-100">
                    <i class="fad fa-home text-lg mr-2"></i>
                    Inicio
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="{{ route('dynamizers.index') }}" class="mb-3 capitalize font-medium text-lg hover:text-teal-600 transition ease-in-out duration-500 text-gray-100">
                    <i class="fad fa-users text-lg mr-2"></i>
                    Dinamizadores
                </a>
                <!-- end link -->
            </div>
            <!-- end sidebar content -->

        </div>
        <!-- end sidbar -->

        <!-- strat content -->
        <div class="bg-gray-100 flex-1 p-4 md:mt-16">

            @yield('content')

        </div>
        <!-- end content -->

    </div>
    <!-- end wrapper -->

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/admin/js/scripts.js"></script>
    <!-- end script -->
    @yield('js')

</body>

</html>