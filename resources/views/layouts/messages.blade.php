@if (Session::has('message'))
    <div class="w-6/12 mx-auto text-white px-6 py-4 rounded bg-green-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fa fa-check"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <h3 class="text-lg font-bold">¡Perfecto! 👏</h3>
            {{ Session::get('message') }}
        </span>
    </div>
@endif
@if (Session::has('info'))
    <div class="w-6/12 mx-auto text-white px-6 py-4 rounded bg-blue-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fa fa-info-circle"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <h3 class="text-lg font-bold">Información ℹ</h3>
            {{ Session::get('info') }}
        </span>
    </div>
@endif
@if (Session::has('error'))
    <div class="w-6/12 mx-auto text-white px-6 py-4 rounded bg-red-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fa fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <h3 class="text-lg font-bold">Error</h3>
            {{ Session::get('error') }}
        </span>
    </div>
@endif
@if ($errors->any())
    <div class="w-6/12 mx-auto text-white px-6 py-4 rounded bg-red-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fa fa-bell"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <h3 class="text-lg font-bold">Error</h3>
            <ul id="errors">
                @foreach ($errors->all() as $error)
                    <li>· {{ $error }}</li>
                @endforeach
            </ul>
        </span>
    </div>
@endif
