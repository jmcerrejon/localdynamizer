@extends('admin.layouts.app')

@section('title', 'Nuevo/Editar Dinamizadores')

@section('content')
<div class="card md:mt-2">
    
    <!-- header -->
    <div class="card-header flex flex-row justify-between">
        <h1 class="h6">Nuevo/Editar Dinamizador</h1>
    </div>
    <!-- end header -->
    
    <!-- body -->
    <div class="card-body grid gap-6 grid-cols-1">
        @include('layouts.messages')

            <form action="{{ isset($dynamizer) ? route('dynamizers.update', $dynamizer->id) : route('dynamizers.store') }}" method="POST"
                class="lg:max-w-screen-lg xl:max-w-screen-xl sm:max-w-screen-sm md:max-w-screen-md border-gray-300 border-solid border-0 box-border leading-6 mx-auto max-w-2xl px-4 text-black w-full"
                styles="quotes: auto;">
                @csrf
                @if (isset($dynamizer)) @method('PUT') @endif
                <div class="border-solid box-border mb-6" style="quotes: auto;">
                    <label
                        class="md:mb-0 border-gray-300 border-0 cursor-default block font-semibold leading-6 mb-1 pr-4 text-gray-700"
                        for="name" style="quotes: auto;">
                        Nombre
                        <span class="border-solid box-border font-semibold text-blue-600" style="quotes: auto;">*</span>
                    </label>
                    <input
                        class="appearance-none border-gray-200 rounded border-2 cursor-text leading-tight mx-0 mb-0 mt-2 overflow-visible py-2 px-4 shadow-xs text-gray-700 w-full focus:bg-white focus:border-purple-500"
                        id="name" name="name" type="text" placeholder="Nombre del dinamizador" required="" value="{{ $dynamizer->name ?? old('name') }}"
                        style="font-family: inherit; font-size: 100%; quotes: auto;" />
                </div>
                <div class="border-solid box-border mb-6" style="quotes: auto;">
                    <label
                        class="md:mb-0 border-gray-300 border-0 cursor-default block font-semibold leading-6 mb-1 pr-4 text-gray-700"
                        for="phone1" style="quotes: auto;">
                        Teléfono
                        <span class="border-solid box-border font-semibold text-blue-600" style="quotes: auto;">*</span>
                    </label>
                    <input
                        class="appearance-none border-gray-200 rounded border-2 cursor-text leading-tight mx-0 mb-0 mt-2 overflow-visible py-2 px-4 shadow-xs text-gray-700 w-full focus:bg-white focus:border-purple-500"
                        id="phone1" name="phone1" type="tel" placeholder="xxx xxx xxx" required="" value="{{ $dynamizer->phone1 ?? old('phone1') }}"
                        style="font-family: inherit; font-size: 100%; quotes: auto;" />
                </div>
                <div class="border-solid box-border mb-6" style="quotes: auto;">
                    <label
                        class="md:mb-0 border-gray-300 border-0 cursor-default block font-semibold leading-6 mb-1 pr-4 text-gray-700"
                        for="email" style="quotes: auto;">
                        Email
                        <span class="border-solid box-border font-semibold text-blue-600" style="quotes: auto;">*</span>
                    </label>
                    <input
                        class="appearance-none border-gray-200 rounded border-2 cursor-text leading-tight mx-0 mb-0 mt-2 overflow-visible py-2 px-4 shadow-xs text-gray-700 w-full focus:bg-white focus:border-purple-500"
                        id="email" name="email" type="email" placeholder="ejemplo@dominio.com" required="" value="{{ $dynamizer->email ?? old('email') }}"
                        style="font-family: inherit; font-size: 100%; quotes: auto;" />
                </div>
                <div class="border-solid box-border mb-6" style="quotes: auto;">
                    <label
                        class="md:mb-0 border-gray-300 border-0 cursor-default block font-semibold leading-6 mb-1 pr-4 text-gray-700"
                        for="city" style="quotes: auto;">
                        Ciudad/Municipio de interés
                    </label>
                    <input
                        class="md:w-1/2 appearance-none border-gray-200 rounded border cursor-text leading-tight mx-0 mb-0 mt-2 overflow-visible py-2 px-4 shadow-xs text-gray-700 w-full focus:bg-white focus:border-purple-500"
                        id="city" name="city" type="text" list="spain-cities"
                        placeholder="Seleccione del cuadro desplegable o escriba municipio" value="{{ $dynamizer->locations[0]->name ?? old('city') }}"
                        style="font-family: inherit; font-size: 100%; quotes: auto;" />
                    <datalist id="spain-cities">
                        <option>Albacete</option>
                        <option>Alicante/Alacant</option>
                        <option>Almería</option>
                        <option>Araba/Álava</option>
                        <option>Asturias</option>
                        <option>Ávila</option>
                        <option>Badajoz</option>
                        <option>Balears, Illes</option>
                        <option>Barcelona</option>
                        <option>Bizkaia</option>
                        <option>Burgos</option>
                        <option>Cáceres</option>
                        <option>Cádiz</option>
                        <option>Cantabria</option>
                        <option>Castellón/Castelló</option>
                        <option>Ciudad Real</option>
                        <option>Córdoba</option>
                        <option>Coruña, A</option>
                        <option>Cuenca</option>
                        <option>Gipuzkoa</option>
                        <option>Girona</option>
                        <option>Granada</option>
                        <option>Guadalajara</option>
                        <option>Huelva</option>
                        <option>Huesca</option>
                        <option>Jaén</option>
                        <option>León</option>
                        <option>Lleida</option>
                        <option>Lugo</option>
                        <option>Madrid</option>
                        <option>Málaga</option>
                        <option>Murcia</option>
                        <option>Navarra</option>
                        <option>Ourense</option>
                        <option>Palencia</option>
                        <option>Palmas, Las</option>
                        <option>Pontevedra</option>
                        <option>Rioja, La</option>
                        <option>Salamanca</option>
                        <option>Santa Cruz de Tenerife</option>
                        <option>Segovia</option>
                        <option>Sevilla</option>
                        <option>Soria</option>
                        <option>Tarragona</option>
                        <option>Teruel</option>
                        <option>Toledo</option>
                        <option>Valencia/València</option>
                        <option>Valladolid</option>
                        <option>Zamora</option>
                        <option>Zaragoza</option>
                        <option>Ceuta</option>
                        <option>Melilla</option>
                    </datalist>
                    <div class="flex-initial">
                        <small class="text-gray-600 normal-case">Especifique si lo desea el municipio por el que se
                            interesa. Recuerde que pasará por un proceso en el que se seleccionará
                            <b class="text-gray-800">un dinamizador por municipio.</b>
                        </small>
                    </div>
                </div>
                <div class="border-solid box-border mb-6" style="quotes: auto;">
                    <div class="md:w-1/2 border-gray-300 border-0 leading-6 text-black" style="quotes: auto;"></div>
                    <div class="border-gray-300 border-0 font-bold leading-6 text-center text-gray-500"
                        style="quotes: auto;">
                        @if (isset($dynamizer))
                            <button type="button" class="" onclick="window.location.href='{{ route('dynamizers.index') }}'">Volver</button>
                        @endif
                        <button
                            class="bg-blue-600 bg-none rounded-full border-solid box-border cursor-pointer font-semibold m-0 overflow-visible py-3 px-16 text-white normal-case"
                            type="submit"
                            style="font-family: inherit; font-size: 100%; line-height: inherit; appearance: button; quotes: auto;">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!-- end body -->
    </div>
@endsection
